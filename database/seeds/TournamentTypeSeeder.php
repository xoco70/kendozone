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
        TournamentType::truncate();
        TournamentType::create(['id' => '1','name' => "local"]);
        TournamentType::create(['id' => '2','name' => "districtal"]);
        TournamentType::create(['id' => '3','name' => "city"]);
        TournamentType::create(['id' => '4','name' => "regional"]);
        TournamentType::create(['id' => '5','name' => "state"]);
        TournamentType::create(['id' => '6','name' => "national"]);
        TournamentType::create(['id' => '7','name' => "continental"]);
        TournamentType::create(['id' => '8','name' => "world"]);

    }
}
