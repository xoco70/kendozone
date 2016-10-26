<?php

namespace App\Http\Controllers;

use App\Championship;
use App\PreliminaryTree;
use App\Tournament;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Collection;

class TreeController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $championships = PreliminaryTree::getChampionships($request);

        foreach ($championships as $championship){
            $settings = $championship->settings;

        }





        // Check if tree
        
        // Get all settings
//        return redirect()->back();
    }
}
