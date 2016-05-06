<?php

use App\Federation;
use Illuminate\Database\Seeder;

class FederationSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return  void
     */

    public function run()
    {

        Federation::truncate();

        factory(Federation::class,5)->create();


    }
}
