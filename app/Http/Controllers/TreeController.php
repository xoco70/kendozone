<?php

namespace App\Http\Controllers;

use App\Grade;
use App\PreliminaryTree;
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
        $championships = PreliminaryTree::getChampionships($request);
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
            if (is_string($generation)){
                flash()->error($generation);
            }else{
                $tree = $generation->run();
                $championship->tree = $tree;
                flash()->success("Success");
            }
        }

        return view('trees.index', compact('championships','grades'));

    }
}
