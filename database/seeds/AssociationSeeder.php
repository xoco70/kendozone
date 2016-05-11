<?php

use App\Association;
use App\User;
use Illuminate\Database\Seeder;

class AssociationSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return  void
     */

    public function run()
    {

        Association::truncate();

        // Create Martin
        $aikem_presidente = factory(User::class)->create(
            ['name' => 'AIKEM_President',
                'email' => 'presidencia@aikem.com',
                'role_id' => Config::get('constants.ROLE_ASSOCIATION_PRESIDENT'),
                'password' => bcrypt('aikem'),
                'verified' => 1,]);

        factory(Association::class, 5)->create();
        factory(Association::class)->create(
            ['federation_id' => 36,
                'president_id' => $aikem_presidente->id,
                'name' => 'AIKEM'
            ]);


    }
}
