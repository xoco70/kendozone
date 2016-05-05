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
        Federation::create(['name' => 'FMK','president_id' => 1,'vicepresident_id' => 1,'secretary_id' => 1,'treasurer_id' => 1,'admin_id' => 1,'country_id' => 484]);
        Federation::create(['name' => 'FMQ','president_id' => 1,'vicepresident_id' => 1,'secretary_id' => 1,'treasurer_id' => 1,'admin_id' => 1,'country_id' => 4]);
        Federation::create(['name' => 'FMW','president_id' => 1,'vicepresident_id' => 1,'secretary_id' => 1,'treasurer_id' => 1,'admin_id' => 1,'country_id' => 8]);
        Federation::create(['name' => 'FME','president_id' => 1,'vicepresident_id' => 1,'secretary_id' => 1,'treasurer_id' => 1,'admin_id' => 1,'country_id' => 10]);
        Federation::create(['name' => 'FMR','president_id' => 1,'vicepresident_id' => 1,'secretary_id' => 1,'treasurer_id' => 1,'admin_id' => 1,'country_id' => 12]);



    }
}
