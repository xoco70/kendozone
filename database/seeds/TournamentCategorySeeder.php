<?php

use App\TournamentCategory;
use Illuminate\Database\Seeder;

class TournamentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TournamentCategory::create(['name' => 'categories.man_first_force']);
        TournamentCategory::create(['name' => 'categories.man_second_force']);

        TournamentCategory::create(['name' => 'categories.woman_first_force']);
        TournamentCategory::create(['name' => 'categories.woman_second_force']);

        TournamentCategory::create(['name' => 'categories.man_team']);
        TournamentCategory::create(['name' => 'categories.woman_team']);
        TournamentCategory::create(['name' => 'categories.mixed_team']);

        TournamentCategory::create(['name' => 'categories.1dan']);
        TournamentCategory::create(['name' => 'categories.2dan']);
        TournamentCategory::create(['name' => 'categories.3dan']);
        TournamentCategory::create(['name' => 'categories.4dan']);
        TournamentCategory::create(['name' => 'categories.5dan']);
        TournamentCategory::create(['name' => 'categories.6dan']);
        TournamentCategory::create(['name' => 'categories.7dan']);
        TournamentCategory::create(['name' => 'categories.8dan']);

        TournamentCategory::create(['name' => 'categories.1danplus']);
        TournamentCategory::create(['name' => 'categories.2danplus']);
        TournamentCategory::create(['name' => 'categories.3danplus']);
        TournamentCategory::create(['name' => 'categories.4danplus']);
        TournamentCategory::create(['name' => 'categories.5danplus']);
        TournamentCategory::create(['name' => 'categories.6danplus']);
        TournamentCategory::create(['name' => 'categories.7danplus']);




    }
}
