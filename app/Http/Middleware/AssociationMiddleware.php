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
            $path = $request->path();
            if ($userLogged->isSuperAdmin())
                return $next($request);


            if ($path == 'associations/create' && $userLogged->isFederationPresident()){
                return $next($request);
            }
            if ($request->method() == 'POST' && $userLogged->isFederationPresident()){
                return $next($request);
            }

            if (preg_match('@/associations/(\d+)/*@', $url, $match) ) {

                $associationId = $match[1];

                if (Auth::user()->associationOwned != null && Auth::user()->associationOwned->id == $associationId) {
                    return $next($request);
                }

                $association = Association::findOrFail($associationId);
                if ($userLogged->federationOwned != null
                    && $association->federation != null
                    && $userLogged->isFederationPresident()
                    && $userLogged->federationOwned->id == $association->federation->id
                )

                    return $next($request);
            }
        }
        throw new UnauthorizedException;


    }
}