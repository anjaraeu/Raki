<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Jobs\DeleteFile;
use App\Jobs\DeleteZip;
use Illuminate\Support\Facades\Hash;
use App\File;

class DeleteController extends Controller
{
    public function manageGroup(Request $request, $slug) {
        // dd($slug);
        $group = Group::where('slug', $slug)->first();
        if (empty($group)) {
            return abort(404);
        }
        if (!$request->filled('password')) {
            return abort(400);
        } elseif (Hash::check($request->input('password'), $group->passwd)) {
            return abort(401);
        } else {
            session()->flash('password', $request->input('password'));
            return view('manage', ['group' => $group]);
        }
    }

    public function deleteGroup(Request $request, $slug) {
        $group = Group::where('slug', $slug)->first();
        if (empty($group)) {
            return abort(404);
        }
        if (session('password', false)) {
            return abort(419);
        } elseif (Hash::check(session('password'), $group->passwd)) {
            return abort(401);
        } else {
            $group->files->each(function($file) {
                DeleteFile::dispatch($file);
            });
            DeleteZip::dispatch($group);
            return redirect('/');
        }
    }

    public function deleteFile(Request $request, $slug) {
        $file = File::where('slug', $slug)->first();
        if (empty($file)) {
            return abort(404);
        }
        if (session('password', false)) {
            return abort(419);
        } elseif (Hash::check(session('password'), $file->group->passwd)) {
            return abort(401);
        } else {
            DeleteFile::dispatch($file);
            return redirect()->back()->with('deleted');
        }
    }
}
