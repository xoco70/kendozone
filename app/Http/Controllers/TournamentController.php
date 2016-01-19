<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategorySettings;
use App\Http\Requests;
use App\Http\Requests\TournamentRequest;
use App\Tournament;
use App\CategoryTournament;
use App\TournamentLevel;
use GeoIP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;

//use App\Place;

class TournamentController extends Controller
{
    protected $currentModelName;

    public function __construct()
    {
        // Fetch the Site Settings object
//        $this->middleware('auth');
//        $this->currentModelName = trans_choice('crud.tournament', 1);
        $this->currentModelName = trans_choice('crud.tournament', 2);
        View::share('currentModelName', $this->currentModelName);
//        View::share('modelPlural', $this->modelPlural);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tournaments = Auth::user()->tournaments()->paginate(Config::get('constants.PAGINATION'));
//        $tournaments = Tournament::paginate(Config::get('constants.PAGINATION'));
//
//        dd($tournaments);
//        $tournaments = Tournament::where('user_id',Auth::user()->id)
//            ->paginate(Config::get('constants.PAGINATION'));;
//        $tournaments = Tournament::

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
        return view('tournaments.create', compact('levels', 'categories', 'tournament'));
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
        return view('tournaments.show', compact('tournament', 'categories', 'levels'));
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
        $settingSize = sizeof($tournament->settings());
        $categorySize = sizeof($tournament->categories);

        // get categories with settings
        $categoriesWithSettings = $tournament->getCategoriesWithSettings();
//        dd($categoriesWithSettings);
        return view('tournaments.edit', compact('tournament', 'levels', 'categories','settingSize','categorySize','categoriesWithSettings'));
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


    public function updateCategory(Request $request, $categorySettingsId)
    {
        $categorySettings = CategorySettings::findOrFail($categorySettingsId);
        $categorySettings->update($request->all());
        flash("success", Lang::get('core.operation_successful'));
        return view("tournaments/categories", compact('categories'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroyTournament($tournamentId)
    {
        Tournament::destroy($tournamentId);
        flash("success", Lang::get('core.operation_successful'));
        return redirect("tournaments");
    }

    public function register($tournamentId){
        $tournament = Tournament::findOrFail($tournamentId);
        if ($tournament->type == 1) // Tournament is open
            return view("categories.register", compact('tournament', 'invite', 'currentModelName'));
        else
            dd("You need an invitation to register in this tournament");
    }

    public function generateTrees($tournamentId)
    {
        $tournament = Tournament::findOrFail($tournamentId);
        $competitors = $tournament->competitors();
        $tournamentCategories = CategoryTournament::where('tournament_id', $tournamentId)->get();
        foreach ($tournamentCategories as $cat) {
            // Get number of area for this category
            $fightingAreas = null;
            $settings = CategorySettings::where('category_tournament_id', $cat->id)->get();
            if (is_null($settings) || sizeof($settings) == 0) {

                // Check general user settings
                $generalSettings = Auth::user()->settings;

                if (is_null($generalSettings) || sizeof($generalSettings) == 0)
                    $fightingAreas = Config::get('constants.CAT_FIGHTING_AREAS');
            } else {
                $fightingAreas = $settings->fightingAreas;
            }


            dd($fightingAreas);
            echo "<h3>" . $cat->category->name . "</h3>";
            $competitors = $tournament->competitors($cat->id);
            echo $competitors;
        }
//        dd($competitors->where('cat_id','2'));
    }


}
