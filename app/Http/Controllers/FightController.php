<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Tournament;
use App\Tree;
use Illuminate\Http\Request;

class FightController extends Controller
{
    /**
     * Display a listing of the fights.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $grades = Grade::pluck('name', 'id');
        $tournament = Tournament::with('championships.tree.fights')->where('slug',$request->tournamentSlug)->first();
        dd($tournament);
        return view('fights.index', compact('tournament','grades'));

    }
}
