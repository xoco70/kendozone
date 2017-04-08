<?php

use App\Association;
use App\Championship;
use App\Competitor;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class CompetitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Competitors seeding!');
        $faker = Faker::create();

//        $grades = Grade::all()->pluck('id')->toArray();
//        $federations = Federation::all()->pluck('id')->toArray();
        $associations = Association::all()->pluck('id')->toArray();
//        $clubs = Club::all()->pluck('id')->toArray();
//        $countries = Country::pluck('id')->toArray();

        $championships = Championship::where('tournament_id', 1)->get();

        foreach ($championships as $championship) {
            $users = factory(User::class, $faker->numberBetween(15, 50))->create(
                ['country_id' => 484,
                    'federation_id' => 36,
                    'association_id' => $faker->randomElement($associations),
                    'role_id' => Config::get('constants.ROLE_USER'),
                    'password' => bcrypt('111111'),
                    'verified' => 1]);
            foreach ($users as $user) {
                factory(Competitor::class)->create([
                    'championship_id' => $championship->id,
                    'user_id' => $user->id,
                    'confirmed' => 1,
                ]);
            }
        }
    }
}
