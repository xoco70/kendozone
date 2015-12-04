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
        Category::create(['name' => 'categories.man_first_force']);
        Category::create(['name' => 'categories.man_second_force']);

        Category::create(['name' => 'categories.woman_first_force']);
        Category::create(['name' => 'categories.woman_second_force']);

        Category::create(['name' => 'categories.man_team']);
        Category::create(['name' => 'categories.woman_team']);
        Category::create(['name' => 'categories.mixed_team']);

        Category::create(['name' => 'categories.1dan']);
        Category::create(['name' => 'categories.2dan']);
        Category::create(['name' => 'categories.3dan']);
        Category::create(['name' => 'categories.4dan']);
        Category::create(['name' => 'categories.5dan']);
        Category::create(['name' => 'categories.6dan']);
        Category::create(['name' => 'categories.7dan']);
        Category::create(['name' => 'categories.8dan']);

        Category::create(['name' => 'categories.1danplus']);
        Category::create(['name' => 'categories.2danplus']);
        Category::create(['name' => 'categories.3danplus']);
        Category::create(['name' => 'categories.4danplus']);
        Category::create(['name' => 'categories.5danplus']);
        Category::create(['name' => 'categories.6danplus']);
        Category::create(['name' => 'categories.7danplus']);




    }
}
