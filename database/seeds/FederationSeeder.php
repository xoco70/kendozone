<?php

use App\Federation;
use App\User;
use Illuminate\Database\Seeder;

class FederationSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return  void
     */

    public function run()
    {

        Federation::truncate();
        for ($i = 0; $i < 5; $i++) {

            $president = factory(User::class)->create(
                ['role_id' => Config::get('constants.ROLE_ADMIN'),
                    'password' => bcrypt('111111'),
                    'verified' => 1,]);
            factory(Federation::class)->create(['president_id' => $president->id]);
        }


    }
}
