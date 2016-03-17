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

        Category::create(['name' => 'categories.man_first_force', 'gender' => 'M', 'isTeam' => 0, 'ageCategory' => 0]);
        Category::create(['name' => 'categories.man_second_force', 'gender' => 'M', 'isTeam' => 0,'ageCategory' => 0]);

        Category::create(['name' => 'categories.woman_first_force', 'gender' => 'F', 'isTeam' => 0,'ageCategory' => 0]);
        Category::create(['name' => 'categories.woman_second_force', 'gender' => 'F', 'isTeam' => 0,'ageCategory' => 0]);

        Category::create(['name' => 'categories.man_isTeam', 'gender' => 'M', 'isTeam' => 1,'ageCategory' => 0]);
        Category::create(['name' => 'categories.woman_isTeam', 'gender' => 'F', 'isTeam' => 1,'ageCategory' => 0]);
        Category::create(['name' => 'categories.mixed_isTeam', 'gender' => 'X', 'isTeam' => 0,'ageCategory' => 0]);

        Category::create(['name' => 'categories.1dan', 'gender' => 'M', 'isTeam' => 0,'ageCategory' => 1]);
        Category::create(['name' => 'categories.2dan', 'gender' => 'M', 'isTeam' => 0,'ageCategory' => 2]);
        Category::create(['name' => 'categories.3dan', 'gender' => 'M', 'isTeam' => 0,'ageCategory' => 3]);
        Category::create(['name' => 'categories.4dan', 'gender' => 'M', 'isTeam' => 0,'ageCategory' => 4]);
        Category::create(['name' => 'categories.5dan', 'gender' => 'M', 'isTeam' => 0,'ageCategory' => 5]);
        Category::create(['name' => 'categories.6dan', 'gender' => 'M', 'isTeam' => 0,'ageCategory' => 0]);
        Category::create(['name' => 'categories.7dan', 'gender' => 'M', 'isTeam' => 0,'ageCategory' => 0]);
        Category::create(['name' => 'categories.8dan', 'gender' => 'M', 'isTeam' => 0,'ageCategory' => 0]);

        Category::create(['name' => 'categories.1danplus', 'gender' => 'F', 'isTeam' => 0,'ageCategory' => 0]);
        Category::create(['name' => 'categories.2danplus', 'gender' => 'F', 'isTeam' => 0,'ageCategory' => 0]);
        Category::create(['name' => 'categories.3danplus', 'gender' => 'F', 'isTeam' => 0,'ageCategory' => 0]);
        Category::create(['name' => 'categories.4danplus', 'gender' => 'F', 'isTeam' => 0,'ageCategory' => 0]);
        Category::create(['name' => 'categories.5danplus', 'gender' => 'F', 'isTeam' => 0,'ageCategory' => 0]);
        Category::create(['name' => 'categories.6danplus', 'gender' => 'F', 'isTeam' => 0,'ageCategory' => 0]);
        Category::create(['name' => 'categories.7danplus', 'gender' => 'F', 'isTeam' => 0,'ageCategory' => 0]);


    }
}
