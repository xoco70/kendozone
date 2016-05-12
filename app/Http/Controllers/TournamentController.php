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
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;
use Response;


class TournamentController extends Controller
{
    protected $currentModelName;

    public function __construct()
    {
        $this->middleware('ownTournament', ['except' => ['index','show']]);
        
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
            $tournaments = Tournament::with('owner')->orderBy('created_at', 'desc')->paginate(Config::get('constants.PAGINATION'));
        } else {
            $tournaments = Auth::user()->tournaments()->with('owner')->orderBy('created_at', 'desc')->paginate(Config::get('constants.PAGINATION'));
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

        return view('tournaments.create', compact('levels', 'categories', 'tournament', 'currentModelName'));
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
        // get categoryTournament Team Registered
//        $teams = CategoryTournament::with(
//            ['ctus' => function ($query) {
//                $query->where('user_id', '=', Auth::user()->id);
//
//            }]
////            ,
////            ['category' => function ($query) {
////                $query->where('isTeam', '=', 1);
////
////            }]
//        )->get();
        $teams ="";
        // CTU where UserId -> categoryTournament -> category where isTeam = 1 --> return Collection (categoryTournaments)

//        dd($ctTeams);
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
//        dd($tournament->competitors->groupBy('user_id'));
        // Statistics for Right Panel
        $numCompetitors = $tournament->competitors->groupBy('user_id')->count();
        $settingSize = $tournament->categorySettings->count();
        $categorySize = $tournament->categoryTournaments->count();

        $selectedCategories = $tournament->categories;
        $baseCategories = Category::take(10)->get();

        // Gives me a list of category containing
        $categories1 = $selectedCategories->merge($baseCategories)->unique();
        $grades = Grade::lists('name', 'id');
        $categories = new Collection();
        foreach ($categories1 as $category) {

            $category->name = trim($category->buildName($grades));
            $categories->push($category);
        }
        $categories = $categories->sortBy(function ($key) {
            return $key;
        })->lists('name', 'id');


        $levels = TournamentLevel::lists('name', 'id');

        return view('tournaments.edit', compact('tournament', 'levels', 'categories', 'settingSize', 'categorySize', 'grades', 'numCompetitors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TournamentRequest|Request $request
     * @param Tournament $tournament
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(TournamentRequest $request, Tournament $tournament)
    {
//        if ($request->ajax()) {
        if ($tournament->update($request->all())) {
            $tournament->categories()->sync($request->input('category'));
            return Response::json(['msg' => trans('msg.tournament_update_successful', ['name' => $tournament->name]), 'status' => 'success']);
        } else {
            return Response::json(['msg' => trans('msg.tournament_update_error', ['name' => $tournament->name]), 'status' => 'error']);
        }
//        }

//        $tournament->update($request->all());
//        $tournament->categories()->sync($request->input('category'));
//        flash()->success(trans('core.operation_successful'));
//        return redirect("tournaments/$tournament->id/edit");
    }


    //TODO is it used???
    /**
     * @param Request $request
     * @param $categorySettingsId
     * @return mixed
     */
    public function updateCategory(Request $request, $categorySettingsId)
    {
        $categorySettings = CategorySettings::findOrFail($categorySettingsId);
        if ($categorySettings->update($request->all())) {
            flash()->success(trans('msg.category_update_successful'));
        } else {
            flash()->error(trans('msg.category_update_error'));
        }

        return view("tournaments/categories", compact('categories'));
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
     */
    public function register(Tournament $tournament)
    {


        if ($tournament->type == 1) {
            // Tournament is open
            return view("categories.register", compact('tournament', 'invite', 'currentModelName'));
        } else
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
                ->paginate(Config::get('constants.PAGINATION'));
        } else {
            $tournaments = Auth::user()->tournaments()->with('owner')
                ->onlyTrashed()
                ->orderBy('created_at', 'desc')
                ->paginate(Config::get('constants.PAGINATION'));
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
//        $competitors = $tournament->competitors();
        $tournamentCategories = CategoryTournament::where('tournament_id', $tournamentId)->get();
        foreach ($tournamentCategories as $tcat) {
            // Get number of area for this category
            $fightingAreas = null;
            $settings = CategorySettings::where('category_tournament_id', $tcat->id)->get();
            if (is_null($settings) || sizeof($settings) == 0) {

                // Check general user settings
                $generalSettings = Auth::user()->settings;

                if (is_null($generalSettings) || sizeof($generalSettings) == 0)
                    $fightingAreas = Config::get('constants.CAT_FIGHTING_AREAS');
            } else {
                $fightingAreas = $settings->fightingAreas;
            }

            echo "<h3>" . $tcat->category->name . "</h3>";
            $competitors = $tournament->competitors()->where('category_tournament_id', $tcat->id);
            echo $competitors;
        }
    }
}
