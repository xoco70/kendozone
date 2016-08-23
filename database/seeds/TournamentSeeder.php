<?php

use App\Championship;
use App\Competitor;
use App\Tournament;
use App\Venue;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;

class TournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $faker = Faker::create();
        $venues = Venue::all()->pluck('id')->toArray();

        // Tournament creation
        Tournament::truncate();
        $faker = Faker\Factory::create();
        $dateIni = $faker->dateTimeBetween('now', '+2 weeks')->format('Y-m-d');
        Tournament::create([
            'user_id' => 1,
            'name' => "Fake Tournoi",
            'dateIni' =>  $dateIni,
            'dateFin' =>  $dateIni,
            'registerDateLimit' =>  $dateIni,
            'sport' => 1,
            'type' => 0,
            'venue_id' => $faker->randomElement($venues),


        ]);
        factory(Tournament::class, 5)->create();


        Championship::truncate();
        for ($i = 0; $i < 10; $i++) {
            try {
                factory(Championship::class)->create();
            } catch (QueryException $e) {
//                $this->command->error("SQL Error: " . $e->getMessage() . "\n");
            } catch (PDOException $e) {
//                $this->command->error("SQL Error: " . $e->getMessage() . "\n");
            }
        }

        // Tournament categories users

        Competitor::truncate();
        for ($i = 0; $i < 30; $i++) {
            try {
                factory(Competitor::class)->create();
            } catch (QueryException $e) {
//                $this->command->error("SQL Error: " . $e->getMessage() . "\n");
            } catch (PDOException $e) {
//                $this->command->error("SQL Error: " . $e->getMessage() . "\n");
            }
        }


//        CategorySettings::truncate();
//        for ($i = 0; $i < 50; $i++) {
//            try {
//                factory(CategorySettings::class)->create();
//            } catch (QueryException $e) {
////                $this->command->error("SQL Error: " . $e->getMessage() . "\n");
//            } catch (PDOException $e) {
////                $this->command->error("SQL Error: " . $e->getMessage() . "\n");
//            }
//        }

    }
}
