<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class CategorySettings extends Model
{
    protected $table = 'category_settings';
    public $timestamps = true;
    protected $fillable = [
        "tournament_id",
        "category_id",
        "isTeam",
        "teamsize",
        "fightDuration",
        "hasEncho",
        "encho_qty",
        "encho_duration",
        "hasRoundRobin",
        "roundRobinWinner",
        "hasHantei",
    ];


    public static function getDefaultSettings()
    {
        $categorySetting = Auth::getUser()->settings;
        if ($categorySetting == null) {
            $categorySetting = new CategorySettings();
            $categorySetting->fightDuration = Config::get('constants.CAT_FIGHT_DURATION');
            $categorySetting->isTeam = Config::get('constants.CAT_ISTEAM');
            $categorySetting->teamsize = Config::get('constants.CAT_TEAMSIZE');
            $categorySetting->hasRoundRobin = Config::get('constants.CAT_HASROUNDROBIN');
            $categorySetting->roundRobinWinner = Config::get('constants.CAT_ROUNDROBINWINNER');
            $categorySetting->hasEncho = Config::get('constants.CAT_HASENCHO');
            $categorySetting->encho_qty = Config::get('constants.CAT_ENCHO_QTY');
            $categorySetting->encho_duration = Config::get('constants.CAT_ENCHO_DURATION');
            $categorySetting->hasHantei = Config::get('constants.CAT_HASHANTEI');

        } else {
            if ($categorySetting->fightDuration  == 0)
                $categorySetting->fightDuration = Config::get('CAT_FIGHT_DURATION');

            if ($categorySetting->hasRoundRobin && $categorySetting->roundRobinWinner == 0)
                $categorySetting->roundRobinWinner = Config::get('CAT_ROUNDROBINWINNER');

            if ($categorySetting->hasEncho && $categorySetting->encho_qty == 0)
                $categorySetting->encho_qty = Config::get('CAT_ENCHO_QTY');

            if ($categorySetting->hasEncho && $categorySetting->encho_duration == 0)
                $categorySetting->encho_duration = Config::get('CAT_ENCHO_DURATION');

        }
    return $categorySetting;
    }

}
