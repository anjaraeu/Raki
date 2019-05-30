<?php

namespace App\Http\Controllers;

use Storage;
use App\File;
use App\Group;
use App\Jobs\EncryptFile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\LinkController;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use App\Jobs\ZipEncryptedGroup;
use App\Jobs\DeleteFile;
use Illuminate\Support\Facades\Hash;

// use App\Helpers\CryptUtil;

class UploadController extends Controller
{
    /**
     * Handles the file upload
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws UploadMissingFileException
     * @throws \Pion\Laravel\ChunkUpload\Exceptions\UploadFailedException
     */
    public function upload(Request $request) {
        // create the file receiver
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));
        // check if the upload is success, throw exception or return response you need
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }
        // receive the file
        $save = $receiver->receive();
        // check if the upload has finished (in chunk mode it will send smaller files)
        if ($save->isFinished()) {
            // save the file and return any response you need, current example uses `move` function. If you are
            // not using move, you need to manually delete the file by unlink($save->getFile()->getPathname())
            return $this->saveFile($save->getFile());
        }
        // we are in chunk mode, lets send the current progress
        /** @var AbstractHandler $handler */
        $handler = $save->handler();
        return response()->json([
            "done" => $handler->getPercentageDone(),
            'status' => true
        ]);
    }

    protected function saveFile(UploadedFile $file) {
        $group = session('pending_group', 'create');
        if ($group === 'create') {
            $group = Group::create([
                'slug' => hash('sha256', random_bytes(25)),
                'name' => 'Untitled'
            ]);
            session(['pending_group' => $group->id]);
        } else {
            $group = Group::findOrFail($group);
        }
        $path = $file->store('files');
        $file = File::create([
            'slug' => hash('sha256', random_bytes(25)),
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'group_id' => $group->id,
            'size' => Storage::size($path),
            'checksum' => md5(Storage::get($path))
        ]);
        $group->load('files');
        return response()->json(['file' => $file, 'group' => $group]);
    }

    public function deleteFile(Request $request) {
        $request->validate(['name' => 'required']);
        if (session('pending_group', 'create') === 'create') {
            return response()->json(['errors' => ['emptygroup' => [__('welcome.error.nogroup')]]], 400);
        }
        $file = File::where([['name', $request->input('name')], ['group_id', session('pending_group')]])->first();
        if (!empty($file)) {
            DeleteFile::dispatchNow($file);
            return response()->json(true);
        } else {
            return response()->json(false, 422);
        }
    }

    public function publishGroup(Request $request) {
        if (session('pending_group', 'create') === 'create') {
            return response()->json(['errors' => ['emptygroup' => [__('welcome.error.nogroup')]]], 400);
        }
        $group = Group::findOrFail(session('pending_group'));
        $request->validate([
            'name' => 'max:250',
            'link' => 'max:25|unique:short_links,link',
            'single' => 'required'
        ]);
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:8|regex:/\\W/'
            ]);
        }
        if ($request->filled('expiry')) {
            $request->validate([
                'expiry' => Rule::in(['86400', '604800', '2635200', '31557600'])
            ]);
            $group->expiry = now()->addSeconds($request->input('expiry'));
        } else {
            $group->expiry = now()->addSeconds(2635200);
        }
        if ($group->files->count() == 0) {
            return abort(400);
        }
        if ($request->filled('password')) {
            $group->encrypted = true;
            $group->files->each(function ($item) {
                global $request;
                EncryptFile::dispatch($item, $request->input('password'));
            });
            ZipEncryptedGroup::dispatch($group, $request->input('password'));
        }
        if ($request->filled('name')) {
            $group->name = $request->input('name');
        } else {
            $group->name = $group->files->first()->name;
        }
        if ($request->input('single')) {
            $group->single = true;
        }

        session(['pending_group' => 'create']);

        $passwd = hash('sha1', random_bytes(50));
        $group->passwd = Hash::make($passwd);
        session()->flash('passwd_group', $passwd);

        $group->save();

        if ($request->ajax()) {
            if ($request->filled('link')) {
                return LinkController::createLinkAjax($group, $request->input('link'));
            } else {
                return response()->json(['link' => route('showGroup', ['slug' => $group->slug])]);
            }
        } else {
            if ($request->filled('link')) {
                return LinkController::createLink($group, $request->input('link'));
            } else {
                return redirect()->route('showGroup', ['slug' => $group->slug]);
            }
        }
    }
}
