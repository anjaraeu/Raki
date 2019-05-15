<?php

namespace App\Http\Controllers;

use Cache;
use Storage;
use App\File;
use App\Group;
use App\Jobs\ZipGroup;
use Illuminate\Http\Request;

class DownloadController extends Controller
{

    public function getFile($slug) {
        $file = File::where('slug', $slug)->get()->first();
        if (empty($file)) {
            abort(404);
        } else {
            if (now()->greaterThan($file->group->expiry)) {
                abort(419);
                // TODO : trigger files delete to free space
            } else {
                return Storage::download($file->path, $file->name);
            }
        }
    }

    public function getGroup($slug) {
        $group = Group::where('slug', $slug)->get()->first();
        if (empty($group)) {
            abort(404);
        } else {
            if (now()->greaterThan($group->expiry)) {
                abort(419);
                // TODO : trigger files delete to free space
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
                abort(419);
                // TODO : trigger files delete to free space
            } else {
                if (Storage::exists('zips/'.$group->slug.'.zip')) {
                    // Storage::download('zips/'.$group->slug.'.zip', 'afilesdl.zip'); <- This doesn't work ? (the same works on L23 wtf)
                    return response()->download(storage_path('app/zips/'.$group->slug.'.zip', ));
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
