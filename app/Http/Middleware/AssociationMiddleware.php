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
            $url = $request->url();
            if ($userLogged->isSuperAdmin())
                return $next($request);


            if (preg_match('@/associations/(\d+)/*@', $url, $match)) {
                $associationId = $match[1];
                if (Auth::user()->associationOwned != null && Auth::user()->associationOwned->id == $associationId) {
                    return $next($request);
                }

                $association = Association::find($associationId);
                if ($userLogged->isFederationPresident() && $userLogged->federation->id == $association->federation->id)
                    return $next($request);
            }
        }
        throw new UnauthorizedException;


    }
}