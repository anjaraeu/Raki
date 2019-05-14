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
            dd($file);
        }
    }

    public function getGroup($slug) {
        $group = Group::where('slug', $slug)->get()->first();
        if (empty($group)) {
            abort(404);
        } else {
            dd($group);
        }
    }

}
