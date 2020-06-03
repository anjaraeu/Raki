<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function userApi(Request $request) {
        if (Auth::id()) {
            return Auth::user();
        } else {
            return abort(404);
        }
    }

    public function dashboard() {
        return view('user.dashboard', ['groups' => Group::where('owner_id', Auth::id())->get()]);
    }
}
