<?php

namespace App\Http\Middleware;

use App\Tournament;
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
        // Check if user own tournament

        if (Auth::check() && ($request->tournament != null || $request->tournamentId != null)) {
            $userLogged = Auth::user();
            $tournaments = $userLogged->tournaments;
            $tournament = $request->tournament;
            if (!$tournament instanceof Tournament) {
                $tournament = Tournament::where('slug', $tournament)->first();
            }
            if ($tournament != null) {
                if (!$tournaments->contains($tournament) && !$userLogged->isSuperAdmin()) {
                    throw new AuthorizationException();
                }
            }
        }
        return $next($request);
    }
}
