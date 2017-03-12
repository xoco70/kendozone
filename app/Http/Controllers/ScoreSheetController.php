<?php

namespace App\Http\Controllers;

use App\Championship;
use Illuminate\Http\Request;

class ScoreSheetController extends Controller
{
    public function index($championshipId)
    {
        $championship = Championship::find($championshipId);
        $sheet = null;
        return view('pdf.scoresheets.sheet', compact('championship','sheet' ));
    }

    public function store()
    {

    }


    public function update()
    {

    }
}
