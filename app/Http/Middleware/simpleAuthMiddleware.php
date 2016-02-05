<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class simpleAuthMiddleware
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
        return Auth::onceBasic('email') ?: $next($request);
    }
}
