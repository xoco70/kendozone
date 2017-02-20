<?php

namespace App\Http\Controllers;

use App\Championship;
use App\Round;
use DaveJamesMiller\Breadcrumbs\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Xoco70\KendoTournaments\Models\ChampionshipSettings;

class ChampionshipSettingsController extends Controller
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
     * @param $championshipId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $championshipId)
    {

        try {

            $request->request->add(['championship_id' => $championshipId]);
            $setting = ChampionshipSettings::create($request->all());
            return Response::json(['settingId' => $setting->id, 'msg' => trans('msg.category_create_successful'), 'status' => 'success']);
        } catch (Exception $e) {
            return Response::json(['msg' => trans('msg.category_create_error'), 'status' => 'error']);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $championshipId
     * @param $championshipSettingsId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $championshipId, $championshipSettingsId)
    {
        try {
            //TODO As it is a WebService, Locale is resetted, as User info

            $cs = ChampionshipSettings::findOrFail($championshipSettingsId)->fill($request->all());

            // If we changed one of those data, remove tree
            if ($cs->isDirty('hasPreliminary') || $cs->isDirty('hasPreliminary') || $cs->isDirty('treeType')) {
                Round::where('championship_id', $championshipId)->delete();
            }
            $cs->save();
            return Response::json(['msg' => trans('msg.category_update_successful'), 'status' => 'success']);
        } catch (Exception $e) {
            return Response::json(['msg' => trans('msg.category_update_error'), 'status' => 'error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ChampionshipSettings $cs
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ChampionshipSettings $cs)
    {
        try {
            $cs->delete();
            return Response::json(['msg' => trans('msg.category_delete_succesful'), 'status' => 'success']);
        } catch (Exception $e) {
            return Response::json(['msg' => trans('msg.category_delete_error'), 'status' => 'error']);
        }
    }

}
