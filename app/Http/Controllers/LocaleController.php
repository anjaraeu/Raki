<?php
namespace App\Http\Controllers;

use App;
use Cookie;
use ExportLocalization;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function getJSON() {
        $arr = ExportLocalization::export()->toFlat();
        $arr['defaultlang'] = App::getLocale();
        return response()->json($arr);
    }

    public function setLocale($lang) { // To avoid some confusion, setLanguage (the middleware) and setLocale (the controller function) is named differently.
        $arr = array_keys(config('app.locales'));
        if (in_array($lang, $arr)) { // Never trust user input
            App::setLocale($lang);
            Cookie::queue(cookie()->forever('lang', $lang));
        } else {
            Cookie::queue('lang', 'en', 1);
        }
        return redirect()->back();
    }
}
