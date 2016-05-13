<?php

namespace App\Http\Middleware;

use App\Association;
use Closure;
use Illuminate\Contracts\Validation\UnauthorizedException;
use Illuminate\Support\Facades\Auth;

class AssociationMiddleware
{
    /**
     * Check that only superUser can edit Federation info
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::check()) {
            $userLogged = Auth::user();
            if (!$userLogged->isSuperAdmin() && !$userLogged->isFederationPresident()) {
                if (!$userLogged->isAssociationPresident()) {
                    throw new UnauthorizedException;
                } else{
                    if ($request->associations != null) {
                            $association = Association::findOrFail($request->associations);
                        if ($association->president_id != $userLogged->id) {
                            throw new UnauthorizedException;
                        }
                    }
                }

            }
        }

        return $next($request);
    }
}