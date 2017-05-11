<?php

namespace App\Http\Controllers;

use App\Category;
use App\Country;
use App\Exceptions\InvitationNeededException;
use App\Grade;
use App\Http\Requests\TournamentRequest;
use App\Http\Requests\VenueRequest;
use App\FightersGroup;
use App\Tournament;
use App\TournamentLevel;
use App\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;


class TournamentController extends Controller
{
    protected $currentModelName;

    public function __construct()
    {
        $this->middleware('ownTournament', ['except' => ['index', 'show', 'register']]);
        $this->middleware('auth')->except(
            'show',
            'register');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $currentModelName = trans_choice('core.tournament', 2);

        if (Auth::user()->isSuperAdmin()) {
            $tournaments = Tournament::with('owner')->withCount('competitors')->latest()->paginate(config('constants.PAGINATION')); // ,'uniqueTrees'
        } else {
            $tournaments = Auth::user()->tournaments()->with('owner')->latest()->paginate(config('constants.PAGINATION'));
        }
        $title = trans('core.tournaments_created');
        return view('tournaments.index', compact('tournaments', 'currentModelName', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentModelName = trans_choice('core.tournament', 1);
        $levels = TournamentLevel::getAllPlucked();
        $categories = Category::take(10)->orderBy('id', 'asc')->pluck('name', 'id');
        $tournament = new Tournament();
        $rules = config('options.rules');
        $rulesCategories = (new Category)->getCategorieslabelByRule();
        return view('tournaments.create', compact('levels', 'categories', 'tournament', 'currentModelName', 'rules', 'rulesCategories'));
    }

    /**
     * Store a new Tournament
     *
     * @param TournamentRequest $form
     * @return \Illuminate\Http\Response
     */
    public function store(TournamentRequest $form)
    {
        $tournament = $form->persist();
        $msg = trans('msg.tournament_create_successful', ['name' => $tournament->name]);
        flash()->success($msg);
        return redirect(URL::action('TournamentController@edit', $tournament->slug));
    }

    /**
     * Display the Tournament.
     *
     * @param Request $request
     * @param $tournamentSlug
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $tournamentSlug)
    {
        $teams = "";
        $grades = Grade::getAllPlucked();
        $tournamentWithTrees = FightersGroup::getTournament($request);
        $venue = $tournamentWithTrees->venue ?? new Venue;
        $tournament = Tournament::with('championships.users', 'championships.category')->find($tournamentWithTrees->id);
        $countries = Country::getAll();

        return view('tournaments.show', compact('tournament', 'tournamentWithTrees', 'grades', 'teams', 'venue', 'countries'));
    }

    /**
     * Show the form for editing the Tournament.
     *
     * @param Tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournament $tournament)
    {

        $tournament = Tournament::with('competitors', 'championshipSettings', 'championships.settings', 'championships.category')
            ->withCount('competitors', 'teams')
            ->find($tournament->id);

        // Statistics for Right Panel
        $countries = Country::getAllPlucked();
        $settingSize = $tournament->championshipSettings->count();
        $categorySize = $tournament->championships->count();
        $hanteiLimit = config('options.hanteiLimit');
        $categories = $tournament->getCategoriesName();
        $grades = Grade::getAllPlucked();
        $venue = $tournament->venue ?? new Venue;
        $levels = TournamentLevel::getAllPlucked();

        return view('tournaments.edit', compact('tournament', 'levels', 'categories', 'settingSize', 'categorySize', 'grades', 'numCompetitors', 'rules', 'hanteiLimit', 'numTeams', 'countries', 'venue'));
    }

    /**
     * Update the Tournament in storage.
     *
     * @param TournamentRequest $request
     * @param VenueRequest $venueRequest
     * @param Tournament $tournament
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TournamentRequest $request, VenueRequest $venueRequest, Tournament $tournament)
    {
        //TODO Shouldn't I have a Policy???
        $venue = $tournament->venue;
        if ($venue == null)
            $venue = new Venue;

        if ($venueRequest->has('venue_name')) {
            $venue->fill($venueRequest->all());
            $venue->save();
        } else {
            $venue = new Venue();
        }
        $res = $request->update($tournament, $venue);
        if ($request->ajax()) {
            $res == 0
                ? $result = Response::json(['msg' => trans('msg.tournament_update_error', ['name' => $tournament->name]), 'status' => 'error'])
                : $result = Response::json(['msg' => trans('msg.tournament_update_successful', ['name' => $tournament->name]), 'status' => 'success']);
            return $result;
        } else {
            $res == 0
                ? flash()->success(trans('msg.tournament_update_error', ['name' => $tournament->name]))
                : flash()->success(trans('msg.tournament_update_successful', ['name' => $tournament->name]));
            return redirect(URL::action('TournamentController@edit', $tournament->slug))->with('activeTab', $request->activeTab);
        }


    }


    /**
     * Remove the Tournament from storage.
     *
     * @param Tournament $tournament
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Tournament $tournament)
    {
        if ($tournament->delete()) {
            return Response::json(['msg' => Lang::get('msg.tournament_delete_successful', ['name' => $tournament->name]), 'status' => 'success']);
        }
        return Response::json(['msg' => Lang::get('msg.tournament_delete_error', ['name' => $tournament->name]), 'status' => 'error']);

    }

    /**
     * @param $tournamentSlug
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($tournamentSlug)
    {
        $tournament = Tournament::withTrashed()->whereSlug($tournamentSlug)->first();
        if ($tournament->restore()) {
            return Response::json(['msg' => Lang::get('msg.tournament_restored_successful', ['name' => $tournament->name]), 'status' => 'success']);
        }

        return Response::json(['msg' => Lang::get('msg.tournament_restored_error', ['name' => $tournament->name]), 'status' => 'error']);

    }

    /**
     * Called when a user want to register an open tournament
     * @param Request $request
     * @param Tournament $tournament
     * @return mixed
     * @throws InvitationNeededException
     */
    public function register(Request $request, Tournament $tournament)
    {

        if (!Auth::check()) {
            Session::flash('message', trans('msg.please_create_account_before_playing', ['tournament' => $tournament->name]));
            return redirect(URL::action('Auth\LoginController@login'));
        }
        if ($tournament->isOpen()) {
            if (Auth::check()) {
                App::setLocale(Auth::user()->locale);
            }

            $grades = Grade::getAllPlucked();
            $tournament = Tournament::with('championships.category', 'championships.users')->find($tournament->id);
            return view("categories.register", compact('tournament', 'invite', 'currentModelName', 'grades'));
        }

        throw new InvitationNeededException();
    }

    /**
     * @return mixed
     */
    public function getDeleted()
    {
        $currentModelName = trans_choice('core.tournament', 2);

        if (Auth::user()->isSuperAdmin()) {
            $tournaments = Tournament::onlyTrashed()->with('owner')
                ->has('owner')
                ->latest()
                ->paginate(config('constants.PAGINATION'));
        } else {
            $tournaments = Auth::user()->tournaments()->with('owner')
                ->onlyTrashed()
                ->latest()
                ->paginate(config('constants.PAGINATION'));
        }

        $title = trans('core.tournaments_deleted');
        return view('tournaments.deleted', compact('tournaments', 'currentModelName', 'title'));
    }


}
