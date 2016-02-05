<?php

use App\ApiKey;
use Illuminate\Database\Seeder;

class ApiKeySeeder extends Seeder {

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

        ApiKey::truncate();
        ApiKey::create(['key' => '111111']);


    }
}
