<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategorySettings;
use App\CategoryTournament;
use App\Exceptions\InvitationNeededException;
use App\Grade;
use App\Http\Requests;
use App\Http\Requests\TournamentRequest;
use App\Tournament;
use App\TournamentLevel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;
use Response;


class TournamentController extends Controller
{
    protected $currentModelName;

    public function __construct()
    {
        $this->middleware('ownTournament', ['except' => ['index', 'show']]);

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
        $levels = TournamentLevel::lists('name', 'id');
        $categories = Category::take(10)->orderBy('id', 'asc')->lists('name', 'id');
        $tournament = new Tournament();
        $rules = config('options.rules');
        $rulesCategories = (new Category)->getCategorieslabelByRule();
        return view('tournaments.create', compact('levels', 'categories', 'tournament', 'currentModelName', 'rules','rulesCategories'));
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
    public function show(Tournament $tournament)
    {
        $teams = "";
        $grades = Grade::lists('name', 'id');
        return view('tournaments.show', compact('tournament', 'grades', 'teams'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournament $tournament)
    {

        $tournament = Tournament::with('competitors', 'categorySettings', 'categoryTournaments.settings', 'categoryTournaments.category')->find($tournament->id);
        // Statistics for Right Panel
        $numCompetitors = $tournament->competitors->groupBy('user_id')->count();
        $settingSize = $tournament->categorySettings->count();
        $categorySize = $tournament->categoryTournaments->count();
        $rules = config('options.rules');
        $hanteiLimit = config('options.hanteiLimit');
        $selectedCategories = $tournament->categories;
        $baseCategories = Category::take(10)->get();
        // Gives me a list of category containing
        $categories1 = $selectedCategories->merge($baseCategories)->unique();
        $grades = Grade::lists('name', 'id');
        $categories = new Collection();
        foreach ($categories1 as $category) {

            $category->alias != '' ? $category->name = $category->alias
                : $category->name = trim($category->buildName($grades));
            $categories->push($category);
        }
        $categories = $categories->sortBy(function ($key) {
            return $key;
        })->pluck('name', 'id');


        $levels = TournamentLevel::pluck('name', 'id');

        return view('tournaments.edit', compact('tournament', 'levels', 'categories', 'settingSize', 'categorySize', 'grades', 'numCompetitors', 'rules', 'hanteiLimit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TournamentRequest|Request $request
     * @param Tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tournament $tournament)
    {


        if ($request->ajax() && $request->has('category')) { // Category Request goes through AJAX
            $res = $tournament->categories()->sync($request->input('category'));
            $res == 0 ? $result = Response::json(['msg' => trans('msg.tournament_update_error', ['name' => $tournament->name]), 'status' => 'error'])
                : $result = Response::json(['msg' => trans('msg.tournament_update_successful', ['name' => $tournament->name]), 'status' => 'success']);
            return $result;
        } else {
            // Check if user will use preset ( IKF, EKF, LAKC)
            $tournament->setAndConfigureCategories($request->rule_id);
            $res = $tournament->update($request->all());
            $res == 0 ? flash()->success(trans('msg.tournament_update_error', ['name' => $tournament->name]))
                : flash()->success(trans('msg.tournament_update_successful', ['name' => $tournament->name]));
            return redirect(URL::action('TournamentController@edit', $tournament->slug));
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Tournament $tournament
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Tournament $tournament)
    {
        if ($tournament->delete()) {
            return Response::json(['msg' => Lang::get('msg.tournament_delete_successful', ['name' => $tournament->name]), 'status' => 'success']);
        } else {
            return Response::json(['msg' => Lang::get('msg.tournament_delete_error', ['name' => $tournament->name]), 'status' => 'error']);
        }
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
        } else {
            return Response::json(['msg' => Lang::get('msg.tournament_restored_error', ['name' => $tournament->name]), 'status' => 'error']);
        }
    }

    /**
     * @param Tournament $tournament
     * @return mixed
     * @throws InvitationNeededException
     */
    public function register(Tournament $tournament)
    {
        if ($tournament->isOpen()) {
            return view("categories.register", compact('tournament', 'invite', 'currentModelName'));
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

    /**
     * @param $tournamentId
     */
    public function generateTrees($tournamentId)
    {
        $tournament = Tournament::findOrFail($tournamentId);
        $tournamentCategories = CategoryTournament::where('tournament_id', $tournamentId)->get();
        foreach ($tournamentCategories as $tcat) {
            // Get number of area for this category
            $fightingAreas = null;
            $settings = CategorySettings::where('category_tournament_id', $tcat->id)->get();
            if (is_null($settings) || sizeof($settings) == 0) {

                // Check general user settings
                $generalSettings = Auth::user()->settings;

                if (is_null($generalSettings) || sizeof($generalSettings) == 0)
                    $fightingAreas = config('constants.CAT_FIGHTING_AREAS');
            } else {
                $fightingAreas = $settings->fightingAreas;
            }

            echo "<h3>" . $tcat->category->name . "</h3>";
            $competitors = $tournament->competitors()->where('category_tournament_id', $tcat->id);
            echo $competitors;
        }
    }
}
