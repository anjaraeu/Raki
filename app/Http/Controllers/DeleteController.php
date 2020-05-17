<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Group;
use App\Jobs\DeleteFile;
use App\Jobs\DeleteZip;
use App\File;
use Illuminate\Support\Carbon;

class DeleteController extends Controller
{
    public function startManage() {
        return view('startmanage');
    }

    public function manageGroup(Request $request, Group $group) {
        $this->authorize('update', [$group, $request->input('password')]);
        session(['password' => $request->input('password')]);
        return view('manage', ['group' => $group]);
    }

    public function deleteGroup(Request $request, Group $group) {
        $this->authorize('update', [$group, session('password', null)]);
        $group->delete();
        session()->forget('password');
        return redirect('/');
    }

    public function deleteFile(Request $request, File $file) {
        $this->authorize('update', [$file->group, session('password', null)]);
        DeleteFile::dispatchNow($file);
        return redirect()->back()->with('deleted', true);
    }
}
