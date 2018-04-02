<?php

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
        TournamentLevel::truncate();
        TournamentLevel::create(['id'=> '0','name' => "ND"]);
//        TournamentLevel::create(['id'=> '1','name' => "core.local"]);
        TournamentLevel::create(['id'=> '2','name' => "core.district"]);
        TournamentLevel::create(['id'=> '3','name' => "core.level_city"]);
        TournamentLevel::create(['id'=> '4','name' => "core.level_state"]);
        TournamentLevel::create(['id'=> '5','name' => "core.regional"]);
        TournamentLevel::create(['id'=> '6','name' => "core.national"]);
        TournamentLevel::create(['id'=> '7','name' => "core.international"]);

    }
}