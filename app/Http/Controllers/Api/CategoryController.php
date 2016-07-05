<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;


class CategoryController extends ApiController
{

    public function getNameAndInsertIfNotExists($isTeam, $gender, $ageCategory, $ageMin, $ageMax,$gradeCategory, $gradeMin, $gradeMax)
    {
        $category = Category::where('isTeam', '=', $isTeam)
            ->where('gender', '=', $gender)
            ->where('gradeCategory', '=', 0)
            ->select('name')
            ->first();

        $newCategoryName = Category::firstOrCreate(
            [
                'name' => $category->name,
                'isTeam' => $isTeam,
                'gender' => $gender,
                'ageCategory' => $ageCategory,
                'ageMin' => $ageMin,
                'ageMax' => $ageMax,
                'gradeCategory' => $gradeCategory,
                'gradeMin' => $gradeMin,
                'gradeMax' => $gradeMax
            ]);
        return $newCategoryName;
    }

    public function getBaseCategories()
    {
        return Category::take(2)->orderBy('id', 'asc')->lists('name', 'id');

    }

}
