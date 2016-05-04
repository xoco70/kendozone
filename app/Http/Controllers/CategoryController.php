<?php

namespace App\Http\Controllers;

use App\CategoryTournament;
use App\Http\Requests;
use App\Http\Requests\CategoryRequest;

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


//        $grades = Grade::orderBy('order', 'asc')->lists('name', 'id');



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
     * @param $categorySettingsId
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
