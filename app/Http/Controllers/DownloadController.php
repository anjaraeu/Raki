<?php

namespace App\Http\Controllers;

use App\File;
use App\Group;
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
                return response()->download(storage_path('app/'.$file->path), $file->name);
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

}
