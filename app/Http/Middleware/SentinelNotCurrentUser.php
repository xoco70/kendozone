<?php

namespace App\Http\Middleware;

use Sentinel;
use Closure;

class SentinelNotCurrentUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Sentinel::getUser();
        $routeID = $request->route()->parameters()['profiles'];

        if ($user->id != $routeID) {
            return redirect()->back();
        }

        return $next($request);
    }
}
