<?php

use App\Category;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Config;


class CategoryTest extends BrowserKitTest
{
    use DatabaseMigrations;


    public function setUp()
    {
        parent::setUp();

    }


    /** @test
     * Create Category API
     */
    public function create_category()
    {
        $simpleUser = factory(User::class)->create(['locale' => 'en', 'role_id' => Config::get('constants.ROLE_USER')]);

        $category = factory(Category::class)->make();

        $cat = Category::where('isTeam', '=', $category->isTeam)
            ->where('gender', '=', $category->gender)
            ->where('gradeCategory', '=', 0);

        if ($category->ageMin != null) $cat = $cat->where('ageMin', $category->ageMin);
        if ($category->ageMax != null) $cat = $cat->where('ageMax', $category->ageMax);
        if ($category->gradeMin != null) $cat = $cat->where('gradeMin', $category->gradeMin);
        if ($category->gradeMax != null) $cat = $cat->where('gradeMax', $category->gradeMax);

        $cat = $cat->select('name')->first();

        if ($cat == null) {
            $cat = new Category();
        }

        $cat->isTeam = $category->isTeam;
        $cat->gender = $category->gender;
        $cat->ageCategory = $category->ageCategory;
        $cat->ageMin = $category->ageMin;
        $cat->ageMax = $category->ageMax;
        $cat->gradeCategory = $category->gradeCategory;
        $cat->gradeMin = $category->gradeMin;
        $cat->gradeMax = $category->gradeMax;
        $cat->name = $category->buildName();


        $data = $cat->toArray();

        $this->actingAs($simpleUser, 'api')
            ->json('POST', '/api/v1/category/create', $data)
            ->seeJson($data)
            ->seeInDatabase('category', $data);
    }
}
