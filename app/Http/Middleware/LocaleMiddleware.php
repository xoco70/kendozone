<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

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
        } else { //TODO Aqui esta mal
            app()->setLocale('en');
        }
        return $next($request);
    }
}
