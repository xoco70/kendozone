<?php

namespace App\Http\Controllers;

use App\CategorySettings;
use App\Tournament;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
{
    protected $currentModelName,$defaultSettings;

    public function __construct()
    {
        // Fetch the Site Settings object
//        $this->middleware('auth');
        $this->currentModelName = trans_choice('crud.category', 2);
        View::share('currentModelName', $this->currentModelName);
        $this->defaultSettings = CategorySettings::getDefaultSettings();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tournamentId)
    {
        $tournament = Tournament::find($tournamentId)->first();
        $categories = $tournament->categories;
        $defaultSettings =  $this->defaultSettings;
        return view("categories.index", compact('categories','defaultSettings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($categorySettingsId)
    {
        dd("CC");

    }


}
