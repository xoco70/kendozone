<?php

namespace App;

class Round extends \Xoco70\KendoTournaments\Models\Round
{
    /**
     * Get tournament with a lot of stuff Inside - Should Change name
     * @param $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function getTournament($request)
    {
        $tournament = null;
        if (Round::hasTournamentInRequest($request)) {
            $tournamentSlug = $request->tournament;
            $tournament = Tournament::with(['championships' => function ($query) use ($request) {
                $query->with([
                    'settings',
                    'category',
                    'rounds' => function ($query) {
                        return $query->with('teams', 'competitors');
                    }]);
            }])
                ->where('slug', $tournamentSlug)->first();
        } elseif (Round::hasChampionshipInRequest($request)) {
            $tournament = Tournament::whereHas('championships', function ($query) use ($request) {
                return $query->where('id', $request->championshipId);
            })
                ->with(['championships' => function ($query) use ($request) {
                    $query->where('id', '=', $request->championshipId)
                        ->with([
                            'settings',
                            'category',
                            'rounds' => function ($query) {
                                return $query->with('teams', 'competitors');
                            }]);
                }])
                ->first();

        }
        return $tournament;
    }
}