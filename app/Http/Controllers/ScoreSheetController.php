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
                     'championships.fightersGroups',
                     'championships.fightersGroups.teams',
                     'championships.fightersGroups.competitors'
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
