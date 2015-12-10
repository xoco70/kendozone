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
        TournamentLevel::truncate();
        TournamentLevel::create(['id'=> '0','name' => "ND"]);
        TournamentLevel::create(['name' => "crud.local"]);
        TournamentLevel::create(['name' => "crud.district"]);
        TournamentLevel::create(['name' => "crud.level_city"]);
        TournamentLevel::create(['name' => "crud.level_state"]);
        TournamentLevel::create(['name' => "crud.regional"]);
        TournamentLevel::create(['name' => "crud.national"]);
        TournamentLevel::create(['name' => "crud.international"]);

    }
}