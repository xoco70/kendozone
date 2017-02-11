<?php

namespace App;

use Illuminate\Support\Collection;

class Tree extends \Xoco70\KendoTournaments\Models\Tree
{
    /**
     * Get tournament with a lot of stuff Inside - Should Change name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function getTournament()
    {
        return Tournament::with(
            'competitors',
            'championshipSettings',
            'championships.settings',
            'championships.category',
            'championships.teams',
            'championships.users'
        )->first();
    }


    /**
     * Get Championships with a lot of stuff Inside - Should Change name
     * @param $request
     * @return Collection
     */
    public static function getChampionships($request)
    {

        $championships = new Collection();
        if (Tree::hasChampionship($request)) {
            $championship = Championship::with('settings', 'category')->find($request->championshipId);
            $championships->push($championship);
        } else if (Tree::hasTournament($request)) {

            $tournament = Tournament::with(
                'championships.settings',
                'championships.category',
                'championships.tree.user1',
                'championships.tree.user2',
                'championships.tree.user3',
                'championships.tree.user4',
                'championships.tree.user5'

            )->where('slug', $request->tournamentId)->first();

            $championships = $tournament->championships;
        }
        return $championships;
    }


}