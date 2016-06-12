<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Validation\UnauthorizedException;
use Illuminate\Support\Facades\Auth;

class SuperAdmin
{
    /**
     * Check the ownership of tournaments
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $userLogged = Auth::user();
            if (!$userLogged->isSuperAdmin()) {
                throw new UnauthorizedException;
            }
        }


        return $next($request);
    }
}
