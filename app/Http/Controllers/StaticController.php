<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;

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

    public function kb($article) {
        if (Storage::exists('md/'.$article.'.'.App::getLocale().'.md')) {
            return view('kb', ['md' => Markdown::convertToHtml(Storage::get('md/'.$article.'.'.App::getLocale().'.md'))]);
        } elseif (Storage::exists('md/'.$article.'.md')) {
            return view('kb', ['md' => Markdown::convertToHtml(Storage::get('md/'.$article.'.md'))]);
        } else {
            return abort(404);
        }
    }

}
