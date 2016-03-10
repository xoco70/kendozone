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

        Category::create(['name' => 'categories.man_first_force', 'gender' => 'M', 'team' => 0]);
        Category::create(['name' => 'categories.man_second_force', 'gender' => 'M', 'team' => 0]);

        Category::create(['name' => 'categories.woman_first_force', 'gender' => 'F', 'team' => 0]);
        Category::create(['name' => 'categories.woman_second_force', 'gender' => 'F', 'team' => 0]);

        Category::create(['name' => 'categories.man_team', 'gender' => 'M', 'team' => 1]);
        Category::create(['name' => 'categories.woman_team', 'gender' => 'F', 'team' => 1]);
        Category::create(['name' => 'categories.mixed_team', 'gender' => 'X', 'team' => 0]);

        Category::create(['name' => 'categories.1dan', 'gender' => 'M', 'team' => 0]);
        Category::create(['name' => 'categories.2dan', 'gender' => 'M', 'team' => 0]);
        Category::create(['name' => 'categories.3dan', 'gender' => 'M', 'team' => 0]);
        Category::create(['name' => 'categories.4dan', 'gender' => 'M', 'team' => 0]);
        Category::create(['name' => 'categories.5dan', 'gender' => 'M', 'team' => 0]);
        Category::create(['name' => 'categories.6dan', 'gender' => 'M', 'team' => 0]);
        Category::create(['name' => 'categories.7dan', 'gender' => 'M', 'team' => 0]);
        Category::create(['name' => 'categories.8dan', 'gender' => 'M', 'team' => 0]);

        Category::create(['name' => 'categories.1danplus', 'gender' => 'F', 'team' => 0]);
        Category::create(['name' => 'categories.2danplus', 'gender' => 'F', 'team' => 0]);
        Category::create(['name' => 'categories.3danplus', 'gender' => 'F', 'team' => 0]);
        Category::create(['name' => 'categories.4danplus', 'gender' => 'F', 'team' => 0]);
        Category::create(['name' => 'categories.5danplus', 'gender' => 'F', 'team' => 0]);
        Category::create(['name' => 'categories.6danplus', 'gender' => 'F', 'team' => 0]);
        Category::create(['name' => 'categories.7danplus', 'gender' => 'F', 'team' => 0]);


    }
}
