<?php

namespace App\Http\Controllers;

use App\CategorySettings;
use App\Http\Requests;
use App\CategoryTournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;

class CategorySettingsController extends Controller
{

    protected $currentModelName, $defaultSettings;

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
//    public function create($tournamentId, $categoryId)
//    {
////        $defaultSettings = $this->defaultSettings;
//        return view("categories.create", compact('tournamentId', 'categoryId')); //, 'defaultSettings'
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $tournamentId,$categoryId)
    {
        $categoryTournament = CategoryTournament::where('tournament_id',$tournamentId)
                                                  ->where('category_id',$categoryId)->first();
        $request->request->add(['category_tournament_id' => $categoryTournament->id]);
        CategorySettings::create($request->all());
        flash("success", Lang::get('core.operation_successful'));
        return redirect("tournaments/$tournamentId/edit");

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
//    public function edit($tournamentId, $categoryId, $settingId)
//    {
//
//        $categorySetting = CategorySettings::findOrFail($settingId);
//
////        dd($categorySetting);
//        return view("categories.edit", compact('tournamentId', 'categoryId', 'categorySetting')); //, 'defaultSettings'
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tournamentId, $categoryId, $categorySettingsId)
    {
        $categorySettings = CategorySettings::findOrFail($categorySettingsId);

        $data = $request->except('_method', '_token');
        $categorySettings->update($data);
//
        flash('success', trans('core.operation_successful'));
        return redirect("tournaments/$tournamentId/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
