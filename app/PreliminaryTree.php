<?php

namespace App;

use App\TreeGen\Preliminary\NationalTournamentGen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use OwenIt\Auditing\AuditingTrait;
use TreeGen\Preliminary\InternationalTournamentGen;
use TreeGen\Preliminary\RegionalTournamentGen;


class PreliminaryTree extends Model
{
    protected $table = 'preliminary_tree';
    public $timestamps = true;
    protected $guarded = ['id'];
    use AuditingTrait;

    public static function hasTournament($request)
    {
        return $request->tournamentId != null;

    }

    public static function hasChampionship($request)
    {
        return $request->championshipId != null; // has return false, don't know why
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

    public static function getGenerationStrategy(ChampionshipSettings $settings)
    {
        $tournament = $settings->championship->tournament;
        switch($tournament->level_id){
            case Config::get('constants.ND'):
                break;
            case Config::get('constants.local'):
                break;
            case Config::get('constants.district'):
                break;
            case Config::get('constants.city'):
                break;
            case Config::get('constants.state'):
                break;
            case Config::get('constants.regional'):
                return new RegionalTournamentGen;
                break;
            case Config::get('constants.national'):
                return new NationalTournamentGen;
                break;
            case Config::get('constants.international'):
                return new InternationalTournamentGen;
                break;
        }
        return "ND";

        // get Area number
        // get tournament type, and get criteria to repart
        // repart into areas
        // Shuffle
        // Analyse Number of competitors to repart Byes
        // Store / Print

    }
}