<?php

namespace App;

use Illuminate\Support\Facades\Auth;

class Competitor extends \Xoco70\LaravelTournaments\Models\Competitor
{
    public static function getShortId($categories, Tournament $tournament)
    {
        $competitor = static::where('user_id', Auth::user()->id)
            ->whereIn('championship_id', $categories)->first();

        if ($competitor != null) {
            return $competitor->short_id;
        }
        return $tournament->competitors()->max('short_id') + 1;

    }
}
