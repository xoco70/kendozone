<?php

namespace App\Http\Middleware;

use App;
use Auth;
use Closure;
use Session;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */

//    protected $languages = ['en','es'];


    public function handle($request, Closure $next)
    {

//        if(!Session::has('locale'))
//        {
//            Session::put('locale', 'en');
//        }
//
//        app()->setLocale(Session::get('locale'));

        $path = $request->path();
        $lang = null;
        if (preg_match('@^lang/(\w+)@', $path, $match)) {
            $lang = $match[1];
        }
        if (Auth::check()) {
            if ($lang == null)
                app()->setLocale(Auth::user()->locale);
            else
                app()->setLocale($lang);
        } else {
            if ($lang != null) {
                app()->setLocale($lang);
            }
        }
        return $next($request);
    }
}
