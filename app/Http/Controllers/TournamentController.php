<?php

namespace App\Http\Controllers;

use App\Http\Requests\TournamentRequest;
use App\Place;
use App\Tournament;
use App\TournamentType;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class TournamentController extends Controller
{
    protected $currentModelName;

    public function __construct()
    {
        // Fetch the Site Settings object
//        $this->middleware('auth');
        $this->currentModelName = trans_choice('crud.tournament', 1);
        $this->modelPlural = trans_choice('crud.tournament', 2);
        View::share('currentModelName', $this->currentModelName);
        View::share('modelPlural', $this->modelPlural);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tournaments = DB::table('tournament')
            ->leftJoin('place', 'place.id', '=', 'tournament.placeId')
            ->select('tournament.*','place.name as place')
            ->get(); //
        return view('tournaments.index', compact('tournaments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = TournamentType::lists('name', 'id');
        $places = Place::lists('name', 'id');
        return view('tournaments.create', compact('places','types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TournamentRequest $request)
    {
        $tournament = $request->all();
        Tournament::create($tournament);
        Session::flash('flash_message', 'Operación Exitosa!');
        return redirect('tournaments');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tournament $tournament)
    {
        $tournament->delete();
        return redirect("tournaments");
//        return view('tournaments.show', compact('tournament'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournament $tournament)
    {
        $types = TournamentType::lists('name', 'id');
        $places = Place::lists('name', 'id');
//        dd($tournaments);
        return view('tournaments.edit', compact('tournament', 'places','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TournamentRequest $request,Tournament $tournament)
    {
        $tournament->update($request->all());
        return redirect("tournaments");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tournament $tournament)
    {

    }
}
