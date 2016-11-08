<?php

namespace App\Http\Controllers;

use App\Grade;
use App\PreliminaryTree;
use App\Tree;
use Illuminate\Http\Request;

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
        return view('trees.index', compact('tournament', 'grades', 'numCompetitors', 'numTeams', 'settingSize', 'categorySize'));
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
        $tournament = PreliminaryTree::getTournament($request);
        foreach ($tournament->championships as $championship) {
            // If no settings has been defined, take default
            $generation = Tree::getGenerationStrategy($championship);
            $generation->championship = $championship;
            dd($generation);
            $tree = $generation->run();
            dd($tree);
            if ($tree->error != null) {
                flash()->error($generation->error);
            } else {

                $championship->tree = $tree;
                flash()->success(trans('msg.championships_tree_generation_success'));
            }
        }

        return view('trees.index', compact('tournament', 'grades'));

    }
}
