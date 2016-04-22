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

        Category::create(['name' => 'categories.mixed_single',  'gender' => 'X', 'isTeam' => 0, 'ageCategory' => 0]);
        Category::create(['name' => 'categories.men_single',    'gender' => 'M', 'isTeam' => 0, 'ageCategory' => 0]);
        Category::create(['name' => 'categories.ladies_single', 'gender' => 'F', 'isTeam' => 0, 'ageCategory' => 0]);
        Category::create(['name' => 'categories.mixed_team',    'gender' => 'X', 'isTeam' => 1, 'ageCategory' => 0]);
        Category::create(['name' => 'categories.men_team',      'gender' => 'M', 'isTeam' => 1, 'ageCategory' => 0]);
        Category::create(['name' => 'categories.ladies_team',   'gender' => 'F', 'isTeam' => 1, 'ageCategory' => 0]);




    }
}
