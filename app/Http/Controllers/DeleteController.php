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
    public function startManage() {
        return view('startmanage');
    }

    public function manageGroup(Request $request, Group $group) {
        if (!$request->filled('password')) {
            return abort(400);
        } elseif (!Hash::check($request->input('password'), $group->passwd)) {
            return redirect()->back();
        } else {
            session(['password' => $request->input('password')]);
            return view('manage', ['group' => $group]);
        }
    }

    public function deleteGroup(Request $request, Group $group) {
        if (!session('password', false)) {
            return abort(419);
        } elseif (!Hash::check(session('password'), $group->passwd)) {
            return abort(401);
        } else {
            $group->files->each(function($file) {
                DeleteFile::dispatch($file);
            });
            DeleteZip::dispatch($group);
            session()->forget('password');
            return redirect('/');
        }
    }

    public function deleteFile(Request $request, File $file) {
        if (!session('password', false)) {
            return abort(419);
        } elseif (!Hash::check(session('password'), $file->group->passwd)) {
            return abort(401);
        } else {
            DeleteFile::dispatchNow($file);
            return redirect()->back()->with('deleted', true);
        }
    }
}
