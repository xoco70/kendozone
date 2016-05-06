<?php

use App\Association;
use Illuminate\Database\Seeder;

class AssociationSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return  void
     */

    public function run()
    {

        Association::truncate();

        factory(Association::class,5)->create();


    }
}
