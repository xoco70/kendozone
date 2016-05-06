<?php

namespace App\Http\Middleware;

use Closure;
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
                return response(view('errors.general',
                    ['code' => '403',
                        'message' => trans('core.forbidden'),
                        'quote' => '“And this is something I must accept - even if, like acid on metal, it is slowly corroding me inside.”',
                        'author' => 'Tabitha Suzuma',
                        'source' => trans('core.forbidden'),
                    ]
                ));
            }
        }


        return $next($request);
    }
}