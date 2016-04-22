<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Requests;


class CategoryController extends ApiController
{

    public function getNameAndInsertIfNotExists($isTeam, $gender, $ageCategory, $ageMin, $ageMax, $gradeMin, $gradeMax)
    {
        Category::
            where('isTeam', '=', $isTeam)
            ->where('gender', '=', $gender)
            ->where('ageCategory', '=', $ageCategory)
            ->where('ageMin', '=', 0)
            ->where('ageMax', '=', 0)
            ->where('gradeMin', '=', 0)
            ->where('gradeMax', '=', 0)
            ->firstOrFail();

        return $newCategoryName = Category::where('isTeam', '=', $isTeam)
            ->where('gender', '=', $gender)
            ->where('ageCategory', '=', $ageCategory)
            ->where('ageMin', '=', $ageMin)
            ->where('ageMax', '=', $ageMax)
            ->where('gradeMin', '=', $gradeMin)
            ->where('gradeMax', '=', $gradeMax)
            ->firstOrNew();
    }

}
