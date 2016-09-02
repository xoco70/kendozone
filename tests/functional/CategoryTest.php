<?php

use App\Category;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Config;


class CategoryTest extends TestCase
{
//    use DatabaseTransactions;


    public function setUp()
    {
        parent::setUp();
        $this->simpleUser = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);

    }


    /** @test
     * Create Category API
     */
    public function create_category()
    {
        $category = factory(Category::class)->make();

        $cat = Category::where('isTeam', '=', $category->isTeam)
            ->where('gender', '=', $category->gender)
            ->where('gradeCategory', '=', 0)
            ->select('name')
            ->first();


        $data = [
            'name' => $cat->name,
            'alias' => $category->alias,
            'isTeam' => $category->isTeam,
            'gender' => $category->gender,
            'age' => $category->ageCategory,
            'ageMin' => $category->ageMin,
            'ageMax' => $category->ageMax,
            'grade' => $category->gradeCategory,
            'gradeMin' => $category->gradeMin,
            'gradeMax' => $category->gradeMax
        ];

        // difference : ageCategory and gradeCategory
        $dataToSee = [
            'name' => $cat->name,
            'alias' => $category->alias,
            'isTeam' => $category->isTeam,
            'gender' => $category->gender,
            'ageCategory' => $category->ageCategory,
            'ageMin' => $category->ageMin,
            'ageMax' => $category->ageMax,
            'gradeCategory' => $category->gradeCategory,
            'gradeMin' => $category->gradeMin,
            'gradeMax' => $category->gradeMax
        ];

        $this->json('POST', '/api/v1/category/create',$data)
            ->seeJson($dataToSee)
            ->seeInDatabase('category', $dataToSee);
    }
}
