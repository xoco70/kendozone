<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Tournament;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\Controller;
use Kendozone\Transformers\TournamentTransformer;


class TournamentController extends ApiController
{

    protected $tournamentTransformer;


    function __construct(TournamentTransformer $tournamentTransformer)
    {
        $this->tournamentTransformer = $tournamentTransformer;
//        $this->beforeFilter('auth.basic', ['on' => 'post']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        if (Auth::user()->isSuperAdmin()) {
            $tournaments = Tournament::orderBy('created_at', 'desc')->paginate(Config::get('constants.PAGINATION'));
        } else {
            $tournaments = Auth::user()->tournaments()->orderBy('created_at', 'desc')
                ->paginate(Config::get('constants.PAGINATION'));
        }

        return $this->respondWithPagination($tournaments, [
            'data' => $this->tournamentTransformer->transformCollection($tournaments->all())
        ]);
//        return $tournaments->json([
//            'total' => count($tournaments),
//            'rows' => $tournaments,
//            'status' => 200,
//            'message' => 'success',
//        ]);
    }

    private function transformCollection($tournaments)
    {
        return array_map([$this, 'transform'], $tournaments->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
//    public function store()
//    {
//        if(!Input::get('title') or !Input::get('body'))
//        {
//            return $this->respondUnprocessableEntity('Parameters failed validation for a lesson.');
//        }
//        Lesson::create(Input::all());
//        return $this->respondCreated('Lesson successfully created.');
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function create()
//    {
//        $currentModelName = trans_choice('crud.tournament', 1);
//        $levels = TournamentLevel::lists('name', 'id');
//        $categories = Category::lists('name', 'id');
//        $tournament = new Tournament();
////        dd($categories);
////        $places = Place::lists('name', 'id');
//        return view('tournaments.create', compact('levels', 'categories', 'tournament','currentModelName'));
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(TournamentRequest $request)
//    {
//        $tournament = Auth::user()->tournaments()->create($request->all());
//        $tournament->categories()->sync($request->input('category'));
//        flash()->success(trans('core.operation_successful'));
////        else flash('error', 'operation_failed!');
//        return redirect("tournaments/$tournament->id/edit");
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  int $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show(Tournament $tournament)
//    {
//        dd("show");
////        dd($tournament);
//        $levels = TournamentLevel::lists('name', 'id');
//
//        $categories = Category::lists('name', 'id');
////        $level = TournamentLevel::where("id","=",$tournament->level_id)->first();
////        $tournament->delete();
////        return redirect("tournaments");
//        return view('tournaments.show', compact('tournament', 'categories', 'levels'));
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param Tournament $tournament
//     * @return \Illuminate\Http\Response
//     */
//    public function edit(Tournament $tournament)
//    {
////        dd($tournament);
//        $categories = Category::lists('name', 'id');
//        $levels = TournamentLevel::lists('name', 'id');
//        $settingSize = sizeof($tournament->settings());
//        $categorySize = sizeof($tournament->categories);
//
//        //TODO Hay que usar tournament instead of cws
//        $tournament = Tournament::with('categoryTournaments.settings')->find($tournament->id);
////        dd($tournament->categoryTournaments->get(5)->settings);
////        $categoriesWithSettings = $tournament->getCategoriesWithSettings();
////        dd($categoriesWithSettings);
//        return view('tournaments.edit', compact('tournament', 'levels', 'categories', 'settingSize', 'categorySize')); // , 'categoriesWithSettings'
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request $request
//     * @param  int $id
//     * @return \Illuminate\Http\Response
//     */
//    public function update(TournamentRequest $request, Tournament $tournament)
//    {
//
//        $tournament->update($request->all());
//        $tournament->categories()->sync($request->input('category'));
//        flash()->success(trans('core.operation_successful'));
//        return redirect("tournaments/$tournament->id/edit");
//    }
//
//
//    public function updateCategory(Request $request, $categorySettingsId)
//    {
//        $categorySettings = CategorySettings::findOrFail($categorySettingsId);
//        $categorySettings->update($request->all());
//        flash()->success(Lang::get('core.operation_successful'));
//        return view("tournaments/categories", compact('categories'));
//    }
//
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int $id
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy(Tournament $tournament)
//    {
//        if ($tournament->delete()) {
//            flash()->success(Lang::get('core.success'));
//        } else
//            flash()->error(Lang::get('core.fail'));
//
//        return redirect("tournaments");
//    }
//
//    public function register($tournamentId)
//    {
//        $tournament = Tournament::findOrFail($tournamentId);
//
//
//        if ($tournament->type == 1) {
//            // Tournament is open
//            return view("categories.register", compact('tournament', 'invite', 'currentModelName'));
//        } else
//            return view('errors.general',
//                ['code' => '403',
//                    'message' => 'Forbidden!',
//                    'quote' => '“You need an invitation to register in this tournament.”',
//                    'author' => 'Admin',
//                    'source' => '',
//                ]
//            );
//    }
//
//    public function generateTrees($tournamentId)
//    {
//        $tournament = Tournament::findOrFail($tournamentId);
////        $competitors = $tournament->competitors();
//        $tournamentCategories = CategoryTournament::where('tournament_id', $tournamentId)->get();
//        foreach ($tournamentCategories as $cat) {
//            // Get number of area for this category
//            $fightingAreas = null;
//            $settings = CategorySettings::where('category_tournament_id', $cat->id)->get();
//            if (is_null($settings) || sizeof($settings) == 0) {
//
//                // Check general user settings
//                $generalSettings = Auth::user()->settings;
//
//                if (is_null($generalSettings) || sizeof($generalSettings) == 0)
//                    $fightingAreas = Config::get('constants.CAT_FIGHTING_AREAS');
//            } else {
//                $fightingAreas = $settings->fightingAreas;
//            }
//
//
//            dd($fightingAreas);
//            echo "<h3>" . $cat->category->name . "</h3>";
//            $competitors = $tournament->competitors($cat->id);
//            echo $competitors;
//        }
////        dd($competitors->where('cat_id','2'));
//    }


}
