<?php

use App\Tournament;
use App\TournamentCategory;
use App\TournamentCategoryUser;
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

        // Tournament creation
        Tournament::truncate();
        Tournament::create([
            'user_id' => 101,
            'name' => "Fake Tournoi",
            'date' => "2016-02-23",
            'registerDateLimit' => "2016-02-23",
            'cost' => 100,
            'sport' => 1,
            'type' => 0,
            'mustPay' => 1,
            'venue' => "CDOM",


        ]);

        // Tournament categories creation
        TournamentCategory::truncate();
        foreach (range(1, 5) as $index) {
            TournamentCategory::create([
                'tournament_id' => 1,
                'category_id' => $index,
            ]);
        }


        // Tournament categories users

        TournamentCategoryUser::truncate();
        $faker = Faker::create();

        foreach (range(2, 50) as $index) {
            TournamentCategoryUser::create([
                'category_tournament_id' => 1,
                'user_id' => $index,
                'confirmed' => $faker->numberBetween(0, 1),
            ]);
        }

        foreach (range(1, 10) as $index) {
            TournamentCategoryUser::create([
                'category_tournament_id' => 2,
                'user_id' => $index,
                'confirmed' => $faker->numberBetween(0, 1),
            ]);
        }

        foreach (range(20, 40) as $index) {
            TournamentCategoryUser::create([
                'category_tournament_id' => 3,
                'user_id' => $index,
                'confirmed' => $faker->numberBetween(0, 1),
            ]);
        }

    }
}
