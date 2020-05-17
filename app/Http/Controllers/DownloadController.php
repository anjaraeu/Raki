<?php

namespace App\Http\Controllers;

use App;
use Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Storage;
use App\File;
use App\Group;
use App\Jobs\ZipGroup;
use App\Helpers\CryptUtil;
use Illuminate\Http\Request;
use LaravelAEAD\Exceptions\DecryptException;
use App\Jobs\DeleteFile;
use App\Jobs\DeleteZip;
use Illuminate\Support\Carbon;

class DownloadController extends Controller
{

    public function getFile(File $file, Request $request) {
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
                    if (Hash::check(CryptUtil::getKey($request->input('password')), $file->password)) {
                        try {
                            return response()->streamDownload(function () use ($request, $file) {
                                CryptUtil::getEncrypter($request->input('password'))->streamDecrypt($file->path);
                            }, normalizeUtf8String($file->name), ['Content-Type' => $file->mime, 'Content-Length' => $file->size]);
                        } catch (\Exception $e) {
                            return response()->json(false);
                        }
                    } else {
                        return redirect()->route('showGroup', ['group' => $file->group]);
                    }
                } else {
                    return abort(400);
                }
            } else {
                if ($file->group->single) {
                    DeleteFile::dispatch($file);
                    if ($file->group->files->count() <= 1) {
                        DeleteZip::dispatch($file->group);
                    }
                }
                return Storage::download($file->path, normalizeUtf8String($file->name));
            }
        }
    }

    public function checkFile(File $file, Request $request) {
        if (now()->greaterThan($file->group->expiry)) {
            $file->group->delete();
            return abort(419);
        } else {
            if ($file->encrypted) {
                if ($request->filled('password')) {
                    if (Hash::check(CryptUtil::getKey($request->input('password')), $file->password)) {
                        return response()->json(true);
                    } else {
                        return response()->json(false);
                    }
                } else {
                    return abort(400);
                }
            } else {
                return abort(400);
            }
        }
    }

    public function previewFile(File $file) {
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
                return abort(400);
            } else {
                // if ($file->group->single) {
                //     DeleteFile::dispatch($file);
                //     if ($file->group->files->count() <= 1) {
                //         DeleteZip::dispatch($file->group);
                //     }
                // }
                return response(Storage::get($file->path), 200, ['Content-Type' => $file->mime]);
            }
        }
    }

    public function getGroup(Group $group) {
        if (now()->greaterThan($group->expiry)) {
            Cache::set('notifications.expiry', true);
            return abort(419);
        } else {
            $group->load('files');
            return view('group', ['group' => $group]);
        }
    }

    public function getGroupZip(Group $group) {
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
                if ($group->encrypted) {
                    session()->flash('zipError');
                    return redirect()->route('showGroup', ['group' => $group]);
                }
                if (!Cache::get('job-group-'.$group->id, false)) {
                    ZipGroup::dispatch($group);
                }
                return view('wait');
            }
        }
    }

}
