<?php

namespace App;

use Illuminate\Support\Collection;

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
                    'tree' => function ($query) {
                        return $query->with('user1', 'user2', 'user3', 'user4', 'user5');
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
                            'tree' => function ($query) {
                                return $query->with('user1', 'user2', 'user3', 'user4', 'user5');
                            }]);
                }])
                ->first();

        }
        return $tournament;
    }


    /**
     * Get Championships with a lot of stuff Inside - Should Change name
     * @param $request
     * @return Collection
     */
//    public static function getChampionships($request)
//    {
//
//        $championships = new Collection();
//        if (Tree::hasChampionship($request)) {
//            $championship = Championship::with('settings', 'category')->find($request->championshipId);
//            $championships->push($championship);
//        } else if (Tree::hasTournament($request)) {
//
//            $tournament = Tournament::with(
//                'championships.settings',
//                'championships.category',
//                'championships.tree.user1',
//                'championships.tree.user2',
//                'championships.tree.user3',
//                'championships.tree.user4',
//                'championships.tree.user5'
//
//            )->where('slug', $request->tournamentId)->first();
//
//            $championships = $tournament->championships;
//        }
//        return $championships;
//    }


}