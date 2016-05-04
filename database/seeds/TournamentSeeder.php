<?php

use App\CategoryTournament;
use App\CategoryTournamentUser;
use App\Tournament;
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
//        $users = User::all()->pluck('id')->toArray();

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
            'mustPay' => 1,
            'venue' => "CDOM",


        ]);
        factory(Tournament::class, 5)->create();


        CategoryTournament::truncate();
        for ($i = 0; $i < 10; $i++) {
            try {
                factory(CategoryTournament::class)->create();
            } catch (QueryException $e) {
//                $this->command->error("SQL Error: " . $e->getMessage() . "\n");
            } catch (PDOException $e) {
//                $this->command->error("SQL Error: " . $e->getMessage() . "\n");
            }
        }

        // Tournament categories users

        CategoryTournamentUser::truncate();
        for ($i = 0; $i < 30; $i++) {
            try {
                factory(CategoryTournamentUser::class)->create();
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
