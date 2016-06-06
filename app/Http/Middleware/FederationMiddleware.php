<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Validation\UnauthorizedException;
use Illuminate\Support\Facades\Auth;

class FederationMiddleware
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
//        if (Auth::check()) {
//            $userLogged = Auth::user();
//            $url = $request->url();
//            if ($userLogged->isSuperAdmin())
//                return $next($request);
//
//            if (preg_match('@/federations/(\d+)/edit@', $url, $match)) {
//                $federationId = $match[1];
//                if (Auth::user()->federationOwned->id == $federationId) {
                    return $next($request);
//                }
//            }
//        }
//        throw new UnauthorizedException;
    }
}