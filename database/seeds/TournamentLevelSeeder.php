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
//        DB::table('Grade')->delete();
        TournamentLevel::truncate();
        TournamentLevel::create(['id'=> '0','name' => "ND"]);
        TournamentLevel::create(['name' => "core.local"]);
        TournamentLevel::create(['name' => "core.district"]);
        TournamentLevel::create(['name' => "core.level_city"]);
        TournamentLevel::create(['name' => "core.level_state"]);
        TournamentLevel::create(['name' => "core.regional"]);
        TournamentLevel::create(['name' => "core.national"]);
        TournamentLevel::create(['name' => "core.international"]);

    }
}