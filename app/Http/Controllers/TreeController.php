<?php

namespace App\Http\Controllers;

use App\Grade;
use App\PreliminaryTree;
use App\Tree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

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
        $championships = PreliminaryTree::getChampionships($request);
        foreach ($championships as $championship) {

            if ($championship->hasPreliminary()) {
                $preliminaryTree = PreliminaryTree::where('championship_id', $championship->id)->get();
                $championship->tree = $preliminaryTree;
            } else {
                // RoundRobin or Direct Elimination
                $championship->tree = null;
            }

        }

        return view('trees.index', compact('championships', 'grades'));
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
                $tree = $generation->run();
                $championship->tree = $tree;
        }
        return view('trees.index', compact('championships','grades'));

    }
}
