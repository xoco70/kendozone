<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Support\Facades\Auth;
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

        protected $languages = ['en', 'es','ja'];


        public function handle($request, Closure $next)
        {
            if (Auth::check()) {
                Session::put('locale', Auth::user()->locale);
            }


            if (Session::has('locale') && in_array(Session::get('locale'), $this->languages)) {
                App::setLocale(Session::get('locale'));
            }

            return $next($request);
        }
    }
