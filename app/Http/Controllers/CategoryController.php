<?php

namespace App\Http\Controllers;

use App\Category;
use App\Championship;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;


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
     * @param Request|CategoryRequest $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $category = Category::where('isTeam', '=', $request->isTeam)
            ->where('gender', '=', $request->gender)
            ->where('gradeCategory', '=', 0)
            ->select('name')
            ->first();

        $newCategoryName = Category::firstOrCreate(
            [
                'name' => $category->name,
                'alias' => $request->alias,
                'isTeam' => $request->isTeam,
                'gender' => $request->gender,
                'ageCategory' => $request->age,
                'ageMin' => $request->ageMin,
                'ageMax' => $request->ageMax,
                'gradeCategory' => $request->grade,
                'gradeMin' => $request->gradeMin,
                'gradeMax' => $request->gradeMax
            ]);
        return $newCategoryName;
    }

//    public function getBaseCategories()
//    {
//        return Category::take(2)->orderBy('id', 'asc')->lists('name', 'id');
//
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $categorySettingsId
     * @return \Illuminate\Http\Response
     */
    public
    function edit($categorySettingsId)
    {

    }

    public
    function show($tournamentId, $categoryId)
    {

        $tc = Championship::where('tournament_id', $tournamentId)
            ->where('category_id', $categoryId)->first();

        dd($tc->category);
    }

}
