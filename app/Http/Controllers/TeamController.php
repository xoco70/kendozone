<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Team;
use App\Tournament;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class TeamController extends Controller
{

    protected $currentModelName;

    public function __construct()
    {
        $this->currentModelName = trans_choice('core.team', 1);
        View::share('currentModelName', $this->currentModelName);

    }

    /**
     * Display a listing of the teams for a tournament.
     *
     * @param Tournament $tournament
     * @return View
     */
    public function index(Tournament $tournament)
    {
        $tournament = Tournament::with('teams', 'teams.championship.category')->find($tournament->id);
        return view("teams.index", compact('tournament'));

    }

    /**
     * Show the form for creating a new competitor.
     *
     * @param Tournament $tournament
     * @return View
     * @throws AuthorizationException
     */
    public function create(Tournament $tournament)
    {
        $team = new Team;
        if (Auth::user()->cannot('create', $tournament)) {
            throw new AuthorizationException();
        }

        // category_tournanemnt_id with categoryName where isTeam == 1

        $cts = $tournament->buildCategoryList();
        return view("teams.form", compact('tournament', 'team', 'cts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeamRequest $request
     * @param Tournament $tournament
     * @return Response
     * @throws AuthorizationException
     */
    public function store(TeamRequest $request, Tournament $tournament)
    {


//        $team = Team::make($request->all());
        $team = new Team;
        if (Auth::user()->cannot('store', $team)) {
            throw new AuthorizationException();
        }
        $team = Team::create($request->all());
        flash()->success(trans('msg.team_create_successful', ['name' => $team->name]));
        return redirect()->route('teams.index', $tournament->slug);

    }

    /**
     * Show the form for creating a new competitor.
     *
     * @param Tournament $tournament
     * @param $teamId
     * @return View
     */
    public function edit(Tournament $tournament, $teamId)
    {
        $team = Team::findOrFail($teamId);

        if (Auth::user()->cannot('edit', $team)) {
            throw new AuthorizationException();
        }
        $cts = $tournament->buildCategoryList();
        return view("teams.form", compact('tournament', 'team', 'cts'));
    }


    /**
     * Update a newly created resource in storage.
     *
     * @param TeamRequest $request
     * @param Tournament $tournament
     * @return Response
     */
    public function update(TeamRequest $request, Tournament $tournament, $teamId)
    {

        $team = Team::findOrFail($teamId);
        if (Auth::user()->cannot('update', $team)) {
            throw new AuthorizationException();
        }

        $team->update($request->all());
        flash()->success(trans('msg.team_update_successful', ['name' => $team->name]));
        return redirect()->route('teams.index', $tournament->slug);

    }

    /**
     * Display the specified resource.
     *
     * @param Tournament $tournament
     * @return Response
     */
    public function show(Tournament $tournament)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tournament $tournament
     * @param $teamId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Tournament $tournament, $teamId)
    {

        $team = Team::findOrFail($teamId);

        if (Auth::user()->cannot('delete', $team)) {
            throw new AuthorizationException();
        }

        if ($team->forceDelete()) {
            return Response::json(['msg' => Lang::get('msg.team_delete_successful', ['name' => $team->name]), 'status' => 'success']);
        }
        return Response::json(['msg' => Lang::get('msg.team_delete_error', ['name' => $team->name]), 'status' => 'error']);

    }

}
