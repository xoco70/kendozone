<?php

namespace App\Http\Controllers;

use App\Grade;
use App\PreliminaryTree;
use App\Tournament;
use App\Tree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

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
        $grades = Grade::pluck('name', 'id');
        $tournament = PreliminaryTree::getTournament($request);
        $numCompetitors = $tournament->competitors->groupBy('user_id')->count();
        $numTeams = $tournament->teams()->count();
        $settingSize = $tournament->championshipSettings->count();
        $categorySize = $tournament->championships->count();
        return view('trees.index', compact('tournament', 'grades','numCompetitors','numTeams','settingSize','categorySize'));
    }

    /**
     * Build Tree
     *
     * @param Request $request
     * @return \Illuminate\Http\Response|string
     */
    public function store(Request $request)
    {
        $grades = Grade::pluck('name', 'id');
        $championships = PreliminaryTree::getChampionships($request);

        foreach ($championships as $championship) {
            // If no settings has been defined, take default
            $generation = Tree::getGenerationStrategy($championship);
            if (is_string($generation)){
                flash()->error($generation);
            }else{
                $tree = $generation->run();
                $championship->tree = $tree;
                flash()->success(trans('msg.championships_tree_generation_success'));
            }
        }

        return view('trees.index', compact('championships','grades'));

    }
}
