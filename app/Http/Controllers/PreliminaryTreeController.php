<?php

namespace App\Http\Controllers;

use App\ChampionshipSettings;
use App\PreliminaryTree;
use ClassPreloader\Factory;
use Illuminate\Http\Request;

class PreliminaryTreeController extends Controller
{
    /**
     * Display a listing of trees.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response|string
     */
    public function store(Request $request)
    {

        $championships = PreliminaryTree::getChampionships($request);

        foreach ($championships as $championship) {
            // If no settings has been defined, take default
            $pt = PreliminaryTree::find($championship->id);
            // Check if PT has already been generated
            if ($pt != null) {
                dump("tree has already been generated");
            } else {
                $generation = PreliminaryTree::getGenerationStrategy($championship);
                $preliminaryTree = $generation->run();
                return view('preliminaryTree.index', compact('preliminaryTree'));
            }


        }

        // Check if tree

        // Get all settings

        // return redirect()->back();
    }
}
