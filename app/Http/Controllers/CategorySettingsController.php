<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategorySettings;
use App\Tournament;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;

class CategorySettingsController extends Controller
{

    protected $currentModelName,$defaultSettings;

    public function __construct()
    {
        // Fetch the Site Settings object
//        $this->middleware('auth');
        $this->currentModelName = trans_choice('crud.categorySettings', 2);
        View::share('currentModelName', $this->currentModelName);
        $this->defaultSettings = CategorySettings::getDefaultSettings();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tournamentId, $categoryId)
    {
        $defaultSettings =  $this->defaultSettings;
        return view("categories.create", compact('tournamentId','categoryId','defaultSettings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$tournamentId, $categoryId)
    {
        $request->request->add(['tournament_id' => $tournamentId ]);
        $request->request->add(['category_id' => $categoryId ]);
        CategorySettings::create($request->all());

        flash("success",Lang::get('core.operation_successfull'));
        return redirect("tournaments/$tournamentId/categories");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($categorySettingsId)
    {
        dd($categorySettingsId);
        $defaultSettings =  $this->defaultSettings;
        return view("categories.create", compact('tournamentId','categoryId','defaultSettings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $categorySettingsId)
    {
        $categorySettings = CategorySettings::findOrFail($categorySettingsId);
        $categorySettings->update($request->all());

        $tournamentId = $request->get("tournament_id");
        $tournament = Tournament::findOrFail($tournamentId);
        $categories = $tournament->categories;

        flash("success",Lang::get('core.operation_successfull'));
        return view("tournaments/categories", compact('categories'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
