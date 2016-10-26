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
            $settings = $championship->settings;
            $pt = PreliminaryTree::find($championship->id);
            // Check if PT has already been generated
            if ($pt!=null) {
                return "tree has already been generated";
            }

            $generation = PreliminaryTree::getGenerationStrategy($settings);
            $generation->run();
        }


        // Check if tree

        // Get all settings
//        return redirect()->back();
    }
}
