<?php

use App\Grade;
use App\TournamentLevel;
use Illuminate\Database\Seeder;

class TournamentLevelSeeder extends Seeder {

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
        TournamentLevel::truncate();        TournamentLevel::create(['name' => "local"]);
        TournamentLevel::create(['name' => "districtal"]);
        TournamentLevel::create(['name' => "city"]);
        TournamentLevel::create(['name' => "regional"]);
        TournamentLevel::create(['name' => "state"]);
        TournamentLevel::create(['name' => "national"]);
        TournamentLevel::create(['name' => "continental"]);
        TournamentLevel::create(['name' => "world"]);

    }
}
