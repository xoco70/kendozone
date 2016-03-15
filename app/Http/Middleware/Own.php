<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use stdClass;

class Own
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
            if ($request->tournaments != null || $request->tournamentId != null) {
//                dd($request);
                $tournaments = $userLogged->tournaments;
                $tournament = $request->tournaments;
                if ($tournament != null) {
                    if (!$tournaments->contains($tournament)
                            && !$userLogged->isSuperAdmin()
                            && !$request->isMethod('show')
                            && !$request->isMethod('get')) {
                        return view('errors.general',
                            ['code' => '403',
                                'message' => trans('core.forbidden'),
                                'quote' => '“And this is something I must accept - even if, like acid on metal, it is slowly corroding me inside.”',
                                'author' => 'Tabitha Suzuma',
                                'source' => trans('core.forbidden'),
                            ]
                        );
                    }
                }
            }// Check if user own user

            else if ($request->users != null || $request->userId != null) {
                $user = $request->users;

                // User is superadmin, or is the user himself
                if ( $userLogged->id != $user->id && !$userLogged->isSuperAdmin() && !$request->isMethod('show')) {
                    return view('errors.general',
                        ['code' => '403',
                            'message' => trans('core.forbidden'),
                            'quote' => '“And this is something I must accept - even if, like acid on metal, it is slowly corroding me inside.”',
                            'author' => 'Tabitha Suzuma',
                            'source' => trans('core.forbidden'),
                        ]
                    );
                }
            }


        }


        return $next($request);
    }
}
