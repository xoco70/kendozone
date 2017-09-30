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
     * @return \Illuminate\Database\Eloquent\Model
     */

    public function store(CategoryRequest $request)
    {
        $category = $request->getCategoryByFilters();

        $category->isTeam = $request->isTeam;
        $category->gender = $request->gender;
        $category->ageCategory = $request->ageCategory;
        $category->ageMin = $request->ageMin;
        $category->ageMax = $request->ageMax;
        $category->gradeCategory = $request->gradeCategory;
        $category->gradeMin = $request->gradeMin;
        $category->gradeMax = $request->gradeMax;
        $category->name = $category->buildName();

        $newCategoryName = Category::firstOrCreate($category->toArray());

        return $newCategoryName;
    }
}
