<?php

namespace App\Http\Controllers;

use App\Championship;
use App\Fight;
use App\Grade;
use App\FightersGroup;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Xoco70\KendoTournaments\Exceptions\TreeGenerationException;
use Xoco70\KendoTournaments\Models\ChampionshipSettings;
use Xoco70\KendoTournaments\TreeGen\TreeGen;

class TreeController extends Controller
{
    /**
     * Display a listing of trees.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $grades = Grade::getAllPlucked();
        $tournament = FightersGroup::getTournament($request);
        return view('trees.index', compact('tournament', 'grades'));
    }

    /**
     * Build Tree
     *
     * @param Request $request
     * @return \Illuminate\Http\Response|string
     * @throws AuthorizationException
     */
    public function store(Request $request)
    {

        $tournament = FightersGroup::getTournament($request);

        if (Auth::user()->cannot('store', [FightersGroup::class, $tournament])) {
            throw new AuthorizationException();
        }
        foreach ($tournament->championships as $championship) {
            $settings = $championship->getSettings();
            $generation = new TreeGen($championship, null, $settings);
            try {

                $tree = $generation->run();

                FightersGroup::generateFights($tree, $settings, $championship);
                flash()->success(trans('msg.championships_tree_generation_success'));

            } catch (TreeGenerationException $e) {
                flash()->error($e->message);
            } finally {
            }

        }

        return redirect(route('tree.index', $tournament->slug))->with('activeTreeTab', $request->activeTreeTab);
    }

    public function single(Request $request)
    {
        $championship = Championship::find($request->championship);
        $grades = Grade::getAllPlucked();
        return view('pdf.tree', compact('championship', 'grades'));
    }

    public function update(Request $request)
    {

        $numFight = 0;
        $championshipId = $request->championshipId;
        $championship = Championship::find($request->championshipId);
        $groups = FightersGroup::with('fights')->where('championship_id', $championshipId)->get();

        $fights = $request->fights;
        foreach ($groups as $group) {
            foreach ($group->fights as $fight) {
                // Find the fight in array, and update order
                $fight->c1 = $fights[$numFight++];
                $fight->c2 = $fights[$numFight++];
                $fight->save();
            }
        }


        flash()->success(trans('msg.tree_edit_successful'));
        return redirect(route('tree.index', $championship->tournament->slug))->with('activeTreeTab', $request->activeTreeTab);
    }

}
