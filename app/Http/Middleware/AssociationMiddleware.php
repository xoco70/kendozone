<?php

namespace App\Http\Middleware;

use App\Association;
use Closure;
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
        $errorResponse = response(view('errors.general',
            ['code' => '403',
                'message' => trans('core.forbidden'),
                'quote' => '“And this is something I must accept - even if, like acid on metal, it is slowly corroding me inside.”',
                'author' => 'Tabitha Suzuma',
                'source' => trans('core.forbidden'),
            ]));

        if (Auth::check()) {

            $userLogged = Auth::user();
            if (!$userLogged->isSuperAdmin() && !$userLogged->isFederationPresident()) {
                if (!$userLogged->isAssociationPresident()) {
                    return $errorResponse;
                } else{
                    if ($request->associations != null) {
                            $association = Association::findOrFail($request->associations);
                        if ($association->president_id != $userLogged->id) {
                            return $errorResponse;
                        }
                    }
                }

            }
        }

        return $next($request);
    }
}