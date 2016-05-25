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
        if (Auth::check()) {
            $userLogged = Auth::user();
            if (!$userLogged->isSuperAdmin()) {
                $url = $request->url();
                if (preg_match('@/federations/(\d+)/edit@', $url, $match)) {
                    $federationId = $match[1];
                    if (Auth::user()->federationOwned->id != $federationId) {
                        throw new UnauthorizedException;
                    }
                }
            }
        }
        return $next($request);
    }
}