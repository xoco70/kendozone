<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Validation\UnauthorizedException;
use Illuminate\Support\Facades\Auth;

class OwnTournament
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

                    if (!$tournaments->contains($tournament) && !$userLogged->isSuperAdmin()) {

                        throw new UnauthorizedException();
                    }
                }
            }
        }


        return $next($request);
    }
}
