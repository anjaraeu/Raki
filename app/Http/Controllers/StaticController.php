<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticController extends Controller {

    public function legal() {
        return view('legal');
    }

    public function privacy() {
        return view('privacy');
    }

}
