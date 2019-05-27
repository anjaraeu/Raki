<?php

namespace App\Http\Controllers;

use Cache;
use Storage;
use App\File;
use App\Group;
use App\Jobs\ZipGroup;
use App\Helpers\CryptUtil;
use Illuminate\Http\Request;
use LaravelAEAD\Exceptions\DecryptException;
use App\Jobs\DeleteFile;
use App\Jobs\DeleteZip;

class DownloadController extends Controller
{

    public function getFile($slug, Request $request) {
        $file = File::where('slug', $slug)->get()->first();
        if (empty($file)) {
            return abort(404);
        } else {
            if (now()->greaterThan($file->group->expiry)) {
                $file->group->files->each(function($file) {
                    DeleteFile::dispatch($file);
                });
                DeleteZip::dispatch($file->group);
                return abort(419);
            } else {
                if ($file->group->encrypted && !$file->encrypted) {
                    return abort(418);
                }
                if ($file->encrypted) {
                    if ($request->filled('password')) {
                        $encrypter = CryptUtil::getEncrypter($request->input('password'));
                        try {
                            $content = $encrypter->decrypt(Storage::get($file->path));
                            if ($content === false) {
                                return 'Wrong password - cannot decrypt';
                            }
                            return response($content, 200, ['content-type' => 'application/octet-stream', 'content-disposition' => 'attachment; filename="'.$file->name.'"']);
                        } catch (DecryptException $e) {
                            return abort(500);
                        }
                    } else {
                        return abort(401);
                    }
                } else {
                    if ($file->group->single) {
                        DeleteFile::dispatch($file);
                    }
                    return Storage::download($file->path, $file->name);
                }
            }
        }
    }

    public function getGroup($slug) {
        $group = Group::where('slug', $slug)->get()->first();
        if (empty($group)) {
            return abort(404);
        } else {
            if (now()->greaterThan($group->expiry)) {
                $group->files->each(function($file) {
                    DeleteFile::dispatch($file);
                });
                DeleteZip::dispatch($group);
                return abort(419);
            } else {
                $group->load('files');
                return view('group', ['group' => $group]);
            }
        }
    }

    public function getGroupZip($slug) {
        $group = Group::where('slug', $slug)->get()->first();
        if (empty($group)) {
            abort(404);
        } else {
            if (now()->greaterThan($group->expiry)) {
                $group->files->each(function($file) {
                    DeleteFile::dispatch($file);
                });
                DeleteZip::dispatch($group);
                return abort(419);
            } else {
                if (Storage::exists('zips/'.$group->slug.'.zip')) {
                    if ($group->single) {
                        $group->files->each(function($file) {
                            DeleteFile::dispatch($file);
                        });
                        DeleteZip::dispatch($group);
                    }
                    return Storage::download('zips/'.$group->slug.'.zip', 'afilesdl_'.preg_replace('/[^A-Za-z \-_0-9]+/', '', $group->name).'.zip');
                } else {
                    if (!Cache::get('job-group-'.$group->id, false)) {
                        ZipGroup::dispatch($group);
                    }
                    return view('wait');
                }
            }
        }
    }

}
