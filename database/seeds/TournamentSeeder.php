<?php

use App\Category;
use App\CategorySettings;
use App\Tournament;
use App\CategoryTournament;
use App\CategoryTournamentUser;
use App\TournamentLevel;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $users = User::all()->pluck('id')->toArray();

        // Tournament creation
        Tournament::truncate();
        Tournament::create([
            'user_id' => 1,
            'name' => "Fake Tournoi",
            'date' => "2016-02-23",
            'registerDateLimit' => "2016-02-23",
            'sport' => 1,
            'type' => 0,
            'mustPay' => 1,
            'venue' => "CDOM",


        ]);
        factory(Tournament::class,5)->create();


        CategoryTournament::truncate();
        factory(CategoryTournament::class,30)->create();

        // Tournament categories users

        CategoryTournamentUser::truncate();
        factory(CategoryTournamentUser::class,50)->create();

        CategorySettings::truncate();
        factory(CategorySettings::class,10)->create();

    }
}
