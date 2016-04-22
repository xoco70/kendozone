<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        // Presets
        Category::create(['name' => 'categories.man_first_force', 'gender' => 'M', 'isTeam' => 0, 'ageCategory' => 0]);
        Category::create(['name' => 'categories.man_second_force', 'gender' => 'M', 'isTeam' => 0, 'ageCategory' => 0]);
        Category::create(['name' => 'categories.woman_first_force', 'gender' => 'F', 'isTeam' => 0, 'ageCategory' => 0]);
        Category::create(['name' => 'categories.woman_second_force', 'gender' => 'F', 'isTeam' => 0, 'ageCategory' => 0]);

        // Team 0

        // Gender X
        Category::create(['name' => 'categories.mixed_single', 'gender' => 'X', 'isTeam' => 0, 'ageCategory' => 0]);
        Category::create(['name' => 'categories.mixed_single_children', 'gender' => 'X', 'isTeam' => 0, 'ageCategory' => 1]);
        Category::create(['name' => 'categories.mixed_single_students', 'gender' => 'X', 'isTeam' => 0, 'ageCategory' => 2]);
        Category::create(['name' => 'categories.mixed_single_adults', 'gender' => 'X', 'isTeam' => 0, 'ageCategory' => 3]);
        Category::create(['name' => 'categories.mixed_single_master', 'gender' => 'X', 'isTeam' => 0, 'ageCategory' => 4]);
//        Category::create(['name' => 'categories.mixed_single', 'gender' => 'X', 'isTeam' => 0, 'ageCategory' => 5]);

        // Gender M
        Category::create(['name' => 'categories.men_single', 'gender' => 'M', 'isTeam' => 0, 'ageCategory' => 0]);
        Category::create(['name' => 'categories.men_single_children', 'gender' => 'M', 'isTeam' => 0, 'ageCategory' => 1]);
        Category::create(['name' => 'categories.men_single_students', 'gender' => 'M', 'isTeam' => 0, 'ageCategory' => 2]);
        Category::create(['name' => 'categories.men_single_adults', 'gender' => 'M', 'isTeam' => 0, 'ageCategory' => 3]);
        Category::create(['name' => 'categories.men_single_master', 'gender' => 'M', 'isTeam' => 0, 'ageCategory' => 4]);
//        Category::create(['name' => 'categories.men_single', 'gender' => 'M', 'isTeam' => 0, 'ageCategory' => 5]);

        // Gender F
        Category::create(['name' => 'categories.ladies_single', 'gender' => 'F', 'isTeam' => 0, 'ageCategory' => 0]);
        Category::create(['name' => 'categories.ladies_single_children', 'gender' => 'F', 'isTeam' => 0, 'ageCategory' => 1]);
        Category::create(['name' => 'categories.ladies_single_students', 'gender' => 'F', 'isTeam' => 0, 'ageCategory' => 2]);
        Category::create(['name' => 'categories.ladies_single_adults', 'gender' => 'F', 'isTeam' => 0, 'ageCategory' => 3]);
        Category::create(['name' => 'categories.ladies_single_master', 'gender' => 'F', 'isTeam' => 0, 'ageCategory' => 4]);
//        Category::create(['name' => 'categories.ladies_single', 'gender' => 'F', 'isTeam' => 0, 'ageCategory' => 5]);


        // Team 1

        // Gender X
        Category::create(['name' => 'categories.mixed_team', 'gender' => 'X', 'isTeam' => 1, 'ageCategory' => 0]);
        Category::create(['name' => 'categories.mixed_team_children', 'gender' => 'X', 'isTeam' => 1, 'ageCategory' => 1]);
        Category::create(['name' => 'categories.mixed_team_students', 'gender' => 'X', 'isTeam' => 1, 'ageCategory' => 2]);
        Category::create(['name' => 'categories.mixed_team_adults', 'gender' => 'X', 'isTeam' => 1, 'ageCategory' => 3]);
        Category::create(['name' => 'categories.mixed_team_master', 'gender' => 'X', 'isTeam' => 1, 'ageCategory' => 4]);
//        Category::create(['name' => 'categories.mixed_team', 'gender' => 'X', 'isTeam' => 1, 'ageCategory' => 5]);

        // Gender M
        Category::create(['name' => 'categories.men_team', 'gender' => 'M', 'isTeam' => 1, 'ageCategory' => 0]);
        Category::create(['name' => 'categories.men_team_children', 'gender' => 'M', 'isTeam' => 1, 'ageCategory' => 1]);
        Category::create(['name' => 'categories.men_team_students', 'gender' => 'M', 'isTeam' => 1, 'ageCategory' => 2]);
        Category::create(['name' => 'categories.men_team_adults', 'gender' => 'M', 'isTeam' => 1, 'ageCategory' => 3]);
        Category::create(['name' => 'categories.men_team_master', 'gender' => 'M', 'isTeam' => 1, 'ageCategory' => 4]);
//        Category::create(['name' => 'categories.mixed_team', 'gender' => 'M', 'isTeam' => 1, 'ageCategory' => 5]);

        // Gender F
        Category::create(['name' => 'categories.ladies_team', 'gender' => 'F', 'isTeam' => 1, 'ageCategory' => 0]);
        Category::create(['name' => 'categories.ladies_team_children', 'gender' => 'F', 'isTeam' => 1, 'ageCategory' => 1]);
        Category::create(['name' => 'categories.ladies_team_students', 'gender' => 'F', 'isTeam' => 1, 'ageCategory' => 2]);
        Category::create(['name' => 'categories.ladies_team_adults', 'gender' => 'F', 'isTeam' => 1, 'ageCategory' => 3]);
        Category::create(['name' => 'categories.ladies_team_master', 'gender' => 'F', 'isTeam' => 1, 'ageCategory' => 4]);
//        Category::create(['name' => 'categories.mixed_team', 'gender' => 'F', 'isTeam' => 1, 'ageCategory' => 5]);



    }
}
