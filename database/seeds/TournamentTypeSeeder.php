<?php

use App\Grade;
use App\TournamentType;
use Illuminate\Database\Seeder;

class TournamentTypeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return  void
     */
    // Can't make it work for now
    public function run()
    {
        //Empty the Grade table
//        DB::table('Grade')->delete();
        TournamentType::truncate();        TournamentType::create(['name' => "local"]);
        TournamentType::create(['name' => "districtal"]);
        TournamentType::create(['name' => "city"]);
        TournamentType::create(['name' => "regional"]);
        TournamentType::create(['name' => "state"]);
        TournamentType::create(['name' => "national"]);
        TournamentType::create(['name' => "continental"]);
        TournamentType::create(['name' => "world"]);

    }
}
