<?php

namespace App\Http\Controllers;

use App\CategorySettings;
use App\CategoryTournament;
use App\Http\Requests;
use App\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Response;

class CategorySettingsController extends Controller
{

    protected $currentModelName, $defaultSettings;

    public function __construct()
    {
        // Fetch the Site Settings object
        $this->currentModelName = trans_choice('core.categorySettings', 2);
        View::share('currentModelName', $this->currentModelName);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $tournamentSlug, $categoryId)
    {
        $tournament = Tournament::findBySlug($tournamentSlug);

        $categoryTournament = CategoryTournament::where('tournament_id', $tournament->id)
            ->where('category_id', $categoryId)->first();

        $request->request->add(['category_tournament_id' => $categoryTournament->id]);

        if ($setting = CategorySettings::create($request->all())) {
            return Response::json(['settingId' =>$setting->id, 'msg' => trans('msg.category_create_successful'), 'status' => 'success']);
        } else {
            return Response::json(['msg' => trans('msg.category_create_error'), 'status' => 'error']);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $tournamentId
     * @param $categoryId
     * @param $categorySettingsId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tournamentId, $categoryId, $categorySettingsId)
    {
        if (CategorySettings::findOrFail($categorySettingsId)->update($request->all())) {
            return Response::json(['msg' => trans('msg.category_update_successful'), 'status' => 'success']);
        } else {
            return Response::json(['msg' => trans('msg.category_update_error'), 'status' => 'error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CategorySettings $cs
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategorySettings $cs)
    {
        if ($cs->delete) {
            return Response::json(['msg' => trans('msg.category_delete_succesful'), 'status' => 'success']);
        } else {
            return Response::json(['msg' => trans('msg.category_delete_error'), 'status' => 'error']);
        }
    }

}
