<?php

namespace App\Http\Controllers;

use App\Category;
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
                'isTeam' => $request->isTeam,
                'gender' => $request->gender,
                'ageCategory' => $request->ageCategory,
                'ageMin' => $request->ageMin,
                'ageMax' => $request->ageMax,
                'gradeCategory' => $request->gradeCategory,
                'gradeMin' => $request->gradeMin,
                'gradeMax' => $request->gradeMax
            ]);
        return $newCategoryName;
    }
}
