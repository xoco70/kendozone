<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Requests;


class CategoryController extends ApiController
{

    public function getName($isTeam, $gender, $ageCategory){
        return Category::where('isTeam', '=', $isTeam)
                        ->where('gender', '=', $gender)
                        ->where('ageCategory', '=', $ageCategory)
                        ->first();

    }

}
