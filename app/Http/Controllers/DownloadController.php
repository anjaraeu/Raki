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
