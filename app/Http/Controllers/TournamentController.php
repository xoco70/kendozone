<?php

namespace App\Http\Controllers;

use App\Category;
use App\Country;
use App\Exceptions\InvitationNeededException;
use App\Grade;
use App\Http\Requests\TournamentRequest;
use App\Http\Requests\VenueRequest;
use App\Tournament;
use App\TournamentLevel;
use App\Round;
use App\Venue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
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
            $tournaments = Tournament::with('owner')->orderBy('created_at', 'desc')->paginate(config('constants.PAGINATION'));
        } else {
            $tournaments = Auth::user()->tournaments()->with('owner')->orderBy('created_at', 'desc')->paginate(config('constants.PAGINATION'));
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
        $levels = TournamentLevel::pluck('name', 'id');
        $categories = Category::take(10)->orderBy('id', 'asc')->pluck('name', 'id');
        $tournament = new Tournament();
        $rules = config('options.rules');
        $rulesCategories = (new Category)->getCategorieslabelByRule();
        return view('tournaments.create', compact('levels', 'categories', 'tournament', 'currentModelName', 'rules', 'rulesCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TournamentRequest $form
     * @return \Illuminate\Http\Response
     */
    public function store(TournamentRequest $form)
    {
        $tournament = $form->persist();
        $msg = trans('msg.tournament_create_successful', ['name' => $tournament->name]);
        flash()->success($msg);
//        else flash('error', 'operation_failed!');
        return redirect(URL::action('TournamentController@edit', $tournament->slug));
    }

    /**
     * Display the specified resource.
     *
     * @param Tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $tournamentSlug)
    {
        $teams = "";
        $grades = Grade::getAllPlucked();


        // Competitors
        $tournamentWithTrees = Round::getTournament($request);
        $venue = $tournamentWithTrees->venue ?? new Venue;
        $tournament = Tournament::with('championships.users', 'championships.category')->find($tournamentWithTrees->id);
        $countries = Country::all();

        return view('tournaments.show', compact('tournament', 'tournamentWithTrees', 'grades', 'teams', 'venue', 'countries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournament $tournament)
    {

        $tournament = Tournament::with('competitors', 'championshipSettings', 'championships.settings', 'championships.category')->find($tournament->id);
        // Statistics for Right Panel
        $countries = Country::pluck('name', 'id');
        $settingSize = $tournament->championshipSettings->count();
        $categorySize = $tournament->championships->count();

        $rules = config('options.rules');
        $hanteiLimit = config('options.hanteiLimit');
        $selectedCategories = $tournament->categories;

        $baseCategories = Category::take(10)->get();
//        // Gives me a list of category containing
        $categories1 = $selectedCategories->merge($baseCategories)->unique();
        $grades = Grade::getAllPlucked();
        $categories = new Collection();

        $venue = $tournament->venue ?? new Venue;

        foreach ($categories1 as $category) {

            $category->alias != ''
                ? $category->name = $category->alias
                : $category->name = trim($category->buildName());
            $categories->push($category);
        }

        $categories = $categories->sortBy(function ($key) {
            return $key;
        })->pluck('name', 'id');


        $levels = TournamentLevel::pluck('name', 'id');

        return view('tournaments.edit', compact('tournament', 'levels', 'categories', 'settingSize', 'categorySize', 'grades', 'numCompetitors', 'rules', 'hanteiLimit', 'numTeams', 'countries', 'venue'));
    }

    /**
     * Update the specified resource in storage.
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
            return redirect(URL::action('TournamentController@edit', $tournament->slug));
        }


    }


    /**
     * Remove the specified resource from storage.
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
            $grades = Grade::getAllPlucked();
            $tournament = Tournament::with('championships.category', 'championships.users')->find($tournament->id);
//            dd($tournament);
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
                ->orderBy('tournament.created_at', 'desc')
                ->paginate(config('constants.PAGINATION'));
        } else {
            $tournaments = Auth::user()->tournaments()->with('owner')
                ->onlyTrashed()
                ->orderBy('created_at', 'desc')
                ->paginate(config('constants.PAGINATION'));
        }

        $title = trans('core.tournaments_deleted');
        return view('tournaments.deleted', compact('tournaments', 'currentModelName', 'title'));
    }

}
