<?php

namespace App;

class FightersGroup extends \Xoco70\KendoTournaments\Models\FightersGroup
{
    /**
     * Get tournament with a lot of stuff Inside - Should Change name
     * @param $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function getTournament($request)
    {
        $tournament = null;
        if (FightersGroup::hasTournamentInRequest($request)) {
            $tournamentSlug = $request->tournament;
            $tournament = Tournament::with(['championships' => function ($query) use ($request) {
                $query->with([
                    'settings',
                    'category',
                    'fightersGroups' => function ($query) {
                        return $query->with('teams', 'competitors', 'fights');
                    }]);
            }])
                ->where('slug', $tournamentSlug)->first();
        } elseif (FightersGroup::hasChampionshipInRequest($request)) {
            $tournament = Tournament::whereHas('championships', function ($query) use ($request) {
                return $query->where('id', $request->championshipId);
            })
                ->with(['championships' => function ($query) use ($request) {
                    $query->where('id', '=', $request->championshipId)
                        ->with([
                            'settings',
                            'category',
                            'fightersGroups' => function ($query) {
                                return $query->with('teams', 'competitors', 'fights');
                            }]);
                }])
                ->first();

        }
        return $tournament;
    }
}