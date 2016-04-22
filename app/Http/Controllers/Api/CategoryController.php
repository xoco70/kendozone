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

         $newCategoryName = Category::firstOrNew(
             ['isTeam'=> $isTeam,
              'gender'=> $gender,
              'ageCategory' => $ageCategory,
              'ageMin' => $ageMin,
              'ageMax' => $ageMax,
              'gradeMin' => $gradeMin,
              'gradeMax' => $gradeMax
             ]);

        return $newCategoryName;
    }
    public function getBaseCategories(){
        return Category::take(2)->orderBy('id', 'asc')->lists('name', 'id');

}

}
