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
                $tournaments = $userLogged->tournaments;
                $tournament = $request->tournaments;
                if ($tournament != null) {
                    if (!$tournaments->contains($tournament)) {
                        return view('errors.general',
                            ['code' => '403',
                                'message' => 'Forbidden!',
                                'quote' => '“And this is something I must accept - even if, like acid on metal, it is slowly corroding me inside.”',
                                'author' => 'Tabitha Suzuma',
                                'source' => 'Forbidden',
                            ]
                        );
                    }
                }
            }// Check if user own user
            else if ($request->users != null || $request->userId != null) {
                $user = $request->users;
                // User is superadmin, or is the user himself
                if ($userLogged->role->name != "SuperAdmin" && $userLogged->id != $user->id) {
                    return view('errors.general',
                        ['code' => '403',
                            'message' => 'Forbidden!',
                            'quote' => '“And this is something I must accept - even if, like acid on metal, it is slowly corroding me inside.”',
                            'author' => 'Tabitha Suzuma',
                            'source' => 'Forbidden',
                        ]
                    );
                }
            }


        }


        return $next($request);
    }
}
