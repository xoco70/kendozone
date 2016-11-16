<?php

namespace App;

use App\TreeGen\DirectEliminationTreeGen;
use App\TreeGen\PreliminaryTreeGen;
use App\TreeGen\RoundRobinTreeGen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

class Tree extends Model
{

    /**
     * @param $request
     * @return Collection
     */
    public static function getChampionships($request)
    {
        $championships = new Collection();
        if (PreliminaryTree::hasChampionship($request)) {
            $championship = Championship::with('settings')->find($request->championshipId);
            $championships->push($championship);
        } else if (PreliminaryTree::hasTournament($request)) {
            $tournament = Tournament::with('championships.settings')->where('slug', $request->tournamentId)->first();
            $championships = $tournament->championships;
        }
        return $championships;
    }

    public static function getGenerationStrategy(Championship $championship)
    {
        $level = null;
        $tournament = $championship->tournament;
        switch ($tournament->level_id) {
            case Config::get('constants.ND'):
                break;
            case Config::get('constants.local'):
                break;
            case Config::get('constants.district'):
                $level = 'club_id';
                break;
            case Config::get('constants.city'):
                $level = 'club_id';
                break;
            case Config::get('constants.state'):
                $level = 'club_id';
                break;
            case Config::get('constants.regional'):
                $level = 'club_id';
                break;
            case Config::get('constants.national'):
                $level = 'association_id';
                break;
            case Config::get('constants.international'):
                $level = 'federation_id';
                break;
        }
//        dd($championship->hasPreliminary());
        if ($championship->hasPreliminary()) {
            return new PreliminaryTreeGen($championship, $level);
        }
        if ($championship->isRoundRobinType()) {
            return new RoundRobinTreeGen($championship, $level);
        }
        if ($championship->isDirectEliminationType()) {
            return new PreliminaryTreeGen($championship, $level);
        }

        return new PreliminaryTreeGen($championship, $level);

    }
}