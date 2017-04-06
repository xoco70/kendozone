<?php

namespace App\Http\Controllers;

use App\Championship;
use App\Tournament;
use Illuminate\Http\Request;

class ScoreSheetController extends Controller
{
    /**
     * @param $tournamentSlug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($tournamentSlug)
    {
        $tournament = Tournament::with(
            'championships.category',
//            'championships.teams',
//            'championships.competitors',
            'championships.settings',
            'championships.fightersGroups.championship.category', // TODO This is not good
            'championships.fightersGroups.teams',
            'championships.fightersGroups.competitors',
            'championships.fightersGroups.fights.group.championship.category', // TODO This is not good
            'championships.fightersGroups.fights.competitor1',
            'championships.fightersGroups.fights.competitor2',
            'championships.fightersGroups.fights.team1',
            'championships.fightersGroups.fights.team2'

        )->where('slug', $tournamentSlug)->first();


        $sheet = null;
        return view('scoresheets.index', compact('tournament', 'sheet'));
    }

    public function store()
    {

    }


    public function update()
    {

    }
}
