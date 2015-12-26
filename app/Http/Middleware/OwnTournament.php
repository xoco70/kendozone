<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use stdClass;

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
            $user = Auth::user();
            $tournaments = $user->tournaments;
            $tournament = null;
            if ($request->tournaments != null || $request->tournamentId != null) {
                $tournament = $request->tournaments;
                if ($tournament != null) {
                    if (!$tournaments->contains($tournament)) {
                        return view('errors.general');
                    }
                }
            }
        }


        return $next($request);
    }
}
