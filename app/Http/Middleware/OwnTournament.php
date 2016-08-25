<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class OwnTournament
{
    /**
     * Check the ownership of tournaments
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws AuthorizationException
     */
    public function handle($request, Closure $next)
    {

        if (Auth::check()) {
            $userLogged = Auth::user();
            // Check if user own tournament

            if ($request->tournament != null || $request->tournamentId != null) {

                $tournaments = $userLogged->tournaments;
                $tournament = $request->tournament;
                if ($tournament != null) {
                    if (!$tournaments->contains($tournament) && !$userLogged->isSuperAdmin()) {

                        throw new AuthorizationException();
                    }
                }
            }
        }


        return $next($request);
    }
}
