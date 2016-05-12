<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Validation\UnauthorizedException;
use Illuminate\Support\Facades\Auth;

class OwnUser
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

            // Check if user own tournament
            if ($request->users != null) {
                $user = $request->users;

                // User is superadmin, or is the user himself
                if ($userLogged->id != $user->id && !$userLogged->isSuperAdmin()) {

                    throw new UnauthorizedException();
                }
            }


        }


        return $next($request);
    }
}
