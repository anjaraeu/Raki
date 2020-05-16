<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use App\File;
use App\Group;
use App\Jobs\EncryptFile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Jobs\ZipEncryptedGroup;
use App\Jobs\DeleteFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

// use App\Helpers\CryptUtil;

class UploadController extends Controller
{

    public function syncFile(Request $request) {
        $file = File::where([['tus_uuid', $request->input('tus_uuid')], ['group_id', null]])->first();
        if ($file === null) {
            Log::notice('BITCONNEEEEEEEECT');
            Log::warning('File '.$request->input('tus_uuid').' is requested for sync but wasn\'t found.');
            return response('Well fuck', 400);
        } else {
            session()->push('pending_files', $file);
            Redis::del('tus:'.$file->tus_uuid);
            return response()->json(true); // TODO: change that
        }
    }

    public function deleteFile(Request $request) {
        $request->validate(['name' => 'required']);
        if (count(session('pending_files', [])) === 0) {
            return response()->json(['errors' => ['emptygroup' => [__('welcome.error.nogroup')]]], 400);
        }
        /*$file = File::where([['name', $request->input('name')], ['group_id', session('pending_group')]])->first();
        if (!empty($file)) {
            DeleteFile::dispatchNow($file);
            return response()->json(true);
        } else {
            return response()->json(false, 422);
        }*/
    }

    public function publishGroup(Request $request) {
        if (session('pending_group', 'create') === 'create') {
            if (count(session('pending_files', [])) >= 1) {
                $group = Group::create([
                    'slug' => hash('sha256', random_bytes(25)),
                    'name' => 'Untitled'
                ]);
                foreach (session('pending_files') as $file) {
                    $file->group()->associate($group);
                    $file->save();
                }
            } else {
                return response()->json(['errors' => ['emptygroup' => [__('welcome.error.nogroup')]]], 400);
            }
        } else {
            $group = Group::findOrFail(session('pending_group'));
        }
        $request->validate([
            'name' => 'max:250',
            'link' => 'max:25|unique:short_links,link',
            'single' => 'required'
        ]);
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:8'
            ]);
        }
        if ($request->filled('expiry')) {
            if ($request->input('expiry') > env('MIX_MAX_EXPIRATION')) {
                return abort(400);
            }
            $request->validate([
                'expiry' => Rule::in(['86400', '604800', '2635200', '31557600'])
            ]);
            $group->expiry = now()->addSeconds($request->input('expiry'));
        } else {
            $group->expiry = now()->addSeconds(env('MIX_DEFAULT_EXPIRATION'));
        }
        if ($group->files->count() == 0) {
            return abort(400);
        }
        if ($request->filled('password')) {
            $group->encrypted = true;
            $group->files->each(function ($item) use ($request) {
                $item->password = hash('sha256', $request->input('password'));
                $item->save();
                EncryptFile::dispatch($item);
            });
            // NOTE: Zips for encrypted are probably gonna be disabled for security reasons, as
            // this allows local bruteforce of passwords.
            // ZipEncryptedGroup::dispatch($group, $request->input('password'));
        }
        if ($request->filled('name')) {
            $group->name = $request->input('name');
        } else {
            $group->name = $group->files->first()->name;
        }
        if ($request->input('single')) {
            $group->single = true;
        }
        if (Auth::user()) {
            $group->owner_id = Auth::id();
        }

        session(['pending_group' => 'create', 'pending_files' => []]);

        $passwd = hash('sha1', random_bytes(50));
        $group->passwd = Hash::make($passwd);

        $group->save();

        if ($request->ajax()) {
            $ret = ['link' => route('showGroup', ['group' => $group]), 'manage' => route('manageGroup', ['group' => $group]).'?password='.$passwd];
            if ($request->filled('link')) {
                $ret['short_link'] = LinkController::createLinkAjax($group, $request->input('link'));
            } else {
                if (!empty(env('LINK_APP_API'))) {
                    $ret['short_link'] = Http::post(env('LINK_APP_API').'/link', [
                        'link' => route('showGroup', ['group' => $group])
                    ])['link'];
                }
            }
            return response()->json($ret);
        } else {
            if ($request->filled('link')) {
                return LinkController::createLink($group, $request->input('link'));
            } else {
                return redirect()->route('showGroup', ['group' => $group]);
            }
        }
    }
}
