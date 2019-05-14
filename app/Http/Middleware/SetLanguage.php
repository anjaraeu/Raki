<?php
namespace App\Http\Middleware;

use App;
use Cookie;
use Closure;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $arr = array_keys(config('app.locales'));
        if ($request->input('lang')) {
            $lang = $request->input('lang');
            if (in_array($lang, $arr)) { // Never trust user input
                App::setLocale($lang);
            }
        } else if ($request->cookie('lang', null)) {
            $lang = $request->cookie('lang', 'en');
            if (in_array($lang, $arr)) { // Never trust user input
                App::setLocale($lang);
            } else {
                Cookie::queue('lang', 'en', 1);
            }
        } else {
            $lang = locale_accept_from_http($request->headers->get('accept-language'));
            App::setLocale(locale_lookup($arr, $lang, true, config('app.locale')));
        }
        return $next($request);
    }
}
