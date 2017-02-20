<?php

use App\Category;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Config;


class CategoryTest extends BrowserKitTest
{
    use DatabaseTransactions;



    public function setUp()
    {
        parent::setUp();

    }


    /** @test
     * Create Category API
     */
    public function create_category()
    {
        $simpleUser = factory(User::class)->create(['role_id' => Config::get('constants.ROLE_USER')]);

        $category = factory(Category::class)->make();

        $cat = Category::where('isTeam', '=', $category->isTeam)
            ->where('gender', '=', $category->gender)
            ->where('gradeCategory', '=', 0)
            ->select('name')
            ->first();


        $data = [
            'name' => $cat->name,
            'isTeam' => $category->isTeam,
            'gender' => $category->gender,
            'ageCategory' => $category->ageCategory,
            'ageMin' => $category->ageMin,
            'ageMax' => $category->ageMax,
            'gradeCategory' => $category->gradeCategory,
            'gradeMin' => $category->gradeMin,
            'gradeMax' => $category->gradeMax,

        ];

        $this->actingAs($simpleUser, 'api')
            ->json('POST', '/api/v1/category/create',$data)
            ->seeJson($data)
            ->seeInDatabase('category', $data);
    }
}
