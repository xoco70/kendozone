<?php

namespace App\Http\Controllers;

use App\Championship;
use App\Http\Requests\TeamRequest;
use App\Team;
use App\Tournament;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
        $tournament = Tournament::with(['championships' => function ($query) {
            $query->with('teams')
                ->whereHas('category', function ($subquery) {
                    $subquery->where('isTeam', '=', 1);
                });
        }])->find($tournament->id);


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
        if (Auth::user()->cannot('create', [Team::class, $tournament])) {
            throw new AuthorizationException();
        }

        // category_tournanemnt_id with categoryName where isTeam == 1

//        $cts = $tournament->buildCategoryList();
        return view("teams.form", compact('tournament', 'team', 'cts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Championship $championship
     * @return View
     * @throws AuthorizationException
     */
    public function store(Request $request, Championship $championship)
    {

        $tournament = $championship->tournament;

        if (Auth::user()->cannot('store', [Team::class, $tournament])) {
            throw new AuthorizationException();
        }
        try {

            $team = Team::create($request->all());
            flash()->success(trans('msg.team_create_successful', ['name' => $team->name]));
        } catch (QueryException $e) {
            flash()->error(trans('msg.team_create_error_already_exists', ['name' => $request->name]));
        }

        return redirect()->back()->with('activeTab', $request->activeTab);
    }

    /**
     * Show the form for creating a new competitor.
     *
     * @param Tournament $tournament
     * @param $teamId
     * @return View
     * @throws AuthorizationException
     */
    public function edit(Tournament $tournament, $teamId)
    {
        $team = Team::findOrFail($teamId);

        if (Auth::user()->cannot('edit', [Team::class, $tournament])) {
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
     * @param $teamId
     * @return Response
     * @throws AuthorizationException
     */
    public function update(TeamRequest $request, Tournament $tournament, $teamId)
    {

        $team = Team::findOrFail($teamId);
        if (Auth::user()->cannot('update', [Team::class, $tournament])) {
            throw new AuthorizationException();
        }

        $team->update($request->all());
        flash()->success(trans('msg.team_edit_successful', ['name' => $team->name]));
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
     * @param Team $team
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Team  $team)
    {


        $tournament = $team->championship->tournament;

        if (Auth::user()->cannot('delete', [Team::class, $tournament])) {
            throw new AuthorizationException();
        }

        if ($team->forceDelete()) {
            return Response::json(['msg' => Lang::get('msg.team_delete_successful', ['name' => $team->name]), 'status' => 'success']);
        }
        return Response::json(['msg' => Lang::get('msg.team_delete_error', ['name' => $team->name]), 'status' => 'error']);

    }
}
