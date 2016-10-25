<?php

namespace App\Http\Controllers;

use App\Championship;
use Illuminate\Http\Request;

use App\Http\Requests;

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
        $championshipId = $request->championshipId;
        $championship = Championship::with('settings')->find($championshipId);
        $settings = $championship->settings;


        
        // Get all settings
//        return redirect()->back();
    }
}
