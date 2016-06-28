<?php

namespace App\Http\Middleware;

use App;
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

        protected $languages = ['en', 'es'];


        public function handle($request, Closure $next)
        {
            if (Session::has('locale') && in_array(Session::get('locale'), $this->languages)) {
                App::setLocale(Session::get('locale'));
            }

            return $next($request);
        }
    }
