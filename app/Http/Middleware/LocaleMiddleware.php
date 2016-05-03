<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Support\Facades\Session;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */


    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            app()->setLocale(Auth::user()->locale);
        }
        else { //TODO Aqui esta mal
            $locale = Session::get('locale');
//            dd($locale);
            app()->setLocale($locale);
        }
        return $next($request);
    }
}
