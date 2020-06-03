<?php

namespace App\Http\Controllers;

use App\File;
use App\Group;
use App\Report;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() {
        $reports = Report::where('processed', false)->get();
        return view('admin.dashboard', ['stats' => [
            'files' => File::count(),
            'groups' => Group::count(),
            'users' => User::count(),
            'reports' => $reports->count()
        ], 'reports' => $reports->groupBy('group_id')]);
    }
}
