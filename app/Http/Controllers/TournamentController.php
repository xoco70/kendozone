<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\TournamentRequest;
//use App\Place;
use App\Tournament;
use App\Category;
use App\TournamentLevel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $tournaments = Tournament::all();

//        dd($tournaments->first()->user->name);
        return view('tournaments.index', compact('tournaments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = TournamentLevel::lists('name', 'id');
        $categories = Category::lists('name', 'id');
        $tournament = new Tournament();
//        dd($categories);
//        $places = Place::lists('name', 'id');
        return view('tournaments.create', compact( 'levels', 'categories','tournament'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TournamentRequest $request)
    {
        $tournament = Auth::user()->tournaments()->create($request->all());
        $tournament->categories()->sync($request->input('category'));
        flash('success', trans('core.operation_successful'));
//        else flash('error', 'operation_failed!');
        return redirect("tournaments/$tournament->id/edit");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tournament $tournament)
    {
        dd("show");
//        dd($tournament);
        $levels = TournamentLevel::lists('name', 'id');

        $categories = Category::lists('name', 'id');
//        $level = TournamentLevel::where("id","=",$tournament->level_id)->first();
//        $tournament->delete();
//        return redirect("tournaments");
        return view('tournaments.show', compact('tournament','categories','levels'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournament $tournament)
    {
//        dd($tournament);
        $categories = Category::lists('name', 'id');
        $levels = TournamentLevel::lists('name', 'id');
//        dd($tournament);
        return view('tournaments.edit', compact('tournament', 'levels','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TournamentRequest $request, Tournament $tournament)
    {

        $tournament->update($request->all());
        $tournament->categories()->sync($request->input('category'));
        flash('success', trans('core.operation_successful'));
        return redirect("tournaments/$tournament->id/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tournament $tournament)
    {

    }
}
