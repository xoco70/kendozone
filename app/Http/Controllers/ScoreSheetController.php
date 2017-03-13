<?php

namespace App\Http\Controllers;

use App\Championship;
use App\Tournament;
use Illuminate\Http\Request;

class ScoreSheetController extends Controller
{
    public function index($tournamentSlug)
    {
        $tournament = Tournament::with('championships')->where('slug', $tournamentSlug)->first();

        $sheet = null;
        return view('scoresheets.index', compact('tournament','sheet' ));
    }

    public function store()
    {

    }


    public function update()
    {

    }
}
