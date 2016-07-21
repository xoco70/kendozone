<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Http\Requests\TournamentUserRequest;
use App\Team;
use App\Tournament;
use Illuminate\Http\Response;
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
     * Display a listing of the resource.
     *
     * @param Tournament $tournament
     * @return View
     */
    public function index(Tournament $tournament)
    {
        $teams = $tournament->teams;
//        dd($teams);
        return view("teams.index", compact('tournament', 'teams'));

    }

    /**
     * Show the form for creating a new competitor.
     *
     * @param Tournament $tournament
     * @return View
     */
    public function create(Tournament $tournament)
    {
        $team = new Team();
        // category_tournanemnt_id with categoryName where isTeam == 1

        $cts = $tournament->buildCategoryList();
        return view("teams.form", compact('tournament', 'team', 'cts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeamRequest|TournamentUserRequest $request
     * @param Tournament $tournament
     * @return Response
     */
    public function store(TeamRequest $request, Tournament $tournament)
    {

        $team = Team::create($request->all());
        flash()->success(trans('msg.team_add_successful', ['name' => $team->name]));
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
}
