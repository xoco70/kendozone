<?php

use App\Association;
use App\Club;
use Illuminate\Database\Seeder;

class ClubSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return  void
     */

    public function run()
    {

        Club::truncate();

        factory(Club::class,5)->create();


    }
}
