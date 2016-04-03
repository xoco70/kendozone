<?php

namespace App\Http\Controllers;

use App\CategorySettings;
use App\Http\Requests\CategoryRequest;
use App\Tournament;
use App\CategoryTournament;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
{
//    protected $currentModelName,$defaultSettings;

    public function __construct()
    {
        // Fetch the Site Settings object
//        $this->middleware('auth');
//        $this->currentModelName = trans_choice('core.category', 2);
//        View::share('currentModelName', $this->currentModelName);
//        $this->defaultSettings = CategorySettings::getDefaultSettings();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index(Tournament $tournament)
//    {
//        $categories = $tournament->categories;
//        $defaultSettings =  $this->defaultSettings;
//        return view("categories.index", compact('categories','defaultSettings'));
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentModelName = trans_choice('core.category', 1);
        return view('categories.create', compact('currentModelName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $currentModelName = trans_choice('core.category', 1);
        return view('categories.create', compact('currentModelName'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($categorySettingsId)
    {
//        dd("CC");

    }

    public function show($tournamentId, $categoryId)
    {

        $tc = CategoryTournament::where('tournament_id', $tournamentId)
            ->where('category_id', $categoryId)->first();

        dd($tc->category);
    }

}
