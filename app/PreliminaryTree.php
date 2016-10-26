<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PreliminaryTree extends Model
{


    public static function hasTournament($request)
    {
        return $request->has('tournamentId');
    }

    public static function hasChampionship($request)
    {
        return $request->has('championshipId');
    }

    /**
     * @param $request
     * @return Collection
     */
    public static function getChampionships($request)
    {
        $championships = new Collection();
        if (PreliminaryTree::hasChampionship($request)){
            $championship = Championship::with('settings')->find($request->championshipId);
            $championships->push($championship);
        }else if (PreliminaryTree::hasTournament($request)){
            $championships = Tournament::with('championships.settings')->find($request->tournamentId);
        }
        return $championships;
    }
}