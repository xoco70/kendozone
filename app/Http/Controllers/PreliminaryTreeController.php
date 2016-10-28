<?php

namespace App\Http\Controllers;

use App\PreliminaryTree;
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
            $preliminaryTree = PreliminaryTree::where('championship_id', $championship->id)->get();
            // Check if PT has already been generated
            if ($preliminaryTree != null && $preliminaryTree->count()>0) {
                dump("PT has already been generated");
                return view('preliminaryTree.index', compact('preliminaryTree'));
            } else {
                $generation = PreliminaryTree::getGenerationStrategy($championship);
                $preliminaryTree = $generation->run();
                return view('preliminaryTree.index', compact('preliminaryTree'));
            }
        }
    }
}
