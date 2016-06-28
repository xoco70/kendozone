<?php

namespace App\Http\Controllers;

use App\CategoryTournament;
use App\Http\Requests;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentModelName = trans_choice('core.category', 1);
        return view('categories.create', compact('currentModelName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $currentModelName = trans_choice('core.category', 1);
        return view('categories.create', compact('currentModelName'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $categorySettingsId
     * @return \Illuminate\Http\Response
     */
    public function edit($categorySettingsId)
    {

    }

    public function show($tournamentId, $categoryId)
    {

        $tc = CategoryTournament::where('tournament_id', $tournamentId)
            ->where('category_id', $categoryId)->first();

        dd($tc->category);
    }

}
