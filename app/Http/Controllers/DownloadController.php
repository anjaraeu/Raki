<?php

namespace App\Http\Controllers;

use App;
use Cache;
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
                        if ($file->group->files->count() <= 1) {
                            DeleteZip::dispatch($file->group);
                        }
                    }
                    return Storage::download($file->path, normalizeUtf8String($file->name));
                }
            }
        }
    }

    public function checkFile(Request $request, $slug) {
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
                if ($file->encrypted) {
                    if ($request->filled('password')) {
                        $encrypter = CryptUtil::getEncrypter($request->input('password'));
                        try {
                            $content = $encrypter->decrypt(Storage::get($file->path));
                            if ($content === false) {
                                return response()->json(false);
                            }
                            return response()->json(true);
                        } catch (DecryptException $e) {
                            return abort(500);
                        }
                    } else {
                        return abort(400);
                    }
                } else {
                    return abort(400);
                }
            }
        }
    }

    public function previewFile($slug) {
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
    }

    public function getGroup($slug) {
        $group = Group::where('slug', $slug)->get()->first();
        if (empty($group)) {
            return abort(404);
        } else {
            if ($group->files->count() == 0) {
                DeleteZip::dispatch($group);
                return abort(419);
            } elseif (now()->greaterThan($group->expiry)) {
                $group->files->each(function($file) {
                    DeleteFile::dispatch($file);
                });
                DeleteZip::dispatch($group);
                return abort(419);
            } else {
                $group->load('files');
                return view('group', ['group' => $group, 'date' => Carbon::parse($group->expiry)->locale(App::getLocale())->isoFormat('LLLL')]);
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
