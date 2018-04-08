<?php

namespace App;

class FightersGroup extends \Xoco70\LaravelTournaments\Models\FightersGroup
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
                    'users',
                    'fightersGroups' => function ($query) {
                        return $query->with('teams', 'competitors', 'fights');
                    }]);
            }])->withCount('competitors', 'teams')
                ->where('slug', $tournamentSlug)->firstOrFail();
        } elseif (FightersGroup::hasChampionshipInRequest($request)) {
            $tournament = Tournament::whereHas('championships', function ($query) use ($request) {
                return $query->where('id', $request->championshipId);
            })
                ->with(['championships' => function ($query) use ($request) {
                    $query->where('id', '=', $request->championshipId)
                        ->with([
                            'settings',
                            'category',
                            'users',
                            'fightersGroups' => function ($query) {
                                return $query->with('teams', 'competitors', 'fights');
                            }]);
                }])
                ->firstOrFail();

        }
        return $tournament;
    }

    /**
     * Check if Request contains tournamentSlug / Should Move to TreeRequest When Built.
     *
     * @param $request
     *
     * @return bool
     */
    public static function hasTournamentInRequest($request)
    {
        return $request->tournament != null;
    }

    /**
     * Check if Request contains championshipId / Should Move to TreeRequest When Built.
     *
     * @param $request
     *
     * @return bool
     */
    public static function hasChampionshipInRequest($request)
    {
        return $request->championshipId != null; // has return false, don't know why
    }
}