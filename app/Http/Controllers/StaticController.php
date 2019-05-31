<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Support\Facades\Storage;

class StaticController extends Controller {

    public function legal() {
        if (Storage::exists('md/legal.md')) {
            return view('legal', ['md' => Markdown::convertToHtml(Storage::get('md/legal.md'))]);
        } else {
            return view('legal', ['md' => '']);
        }
    }

    public function privacy() {
        if (Storage::exists('md/privacy.md')) {
            return view('privacy', ['md' => Markdown::convertToHtml(Storage::get('md/privacy.md'))]);
        } else {
            return view('privacy', ['md' => '']);
        }
    }

}
