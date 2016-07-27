<?php

use App\Venue;
use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('venue')->truncate();
        factory(Venue::class, 5)->create();

        $this->command->info('Venues seeded!');
    }
}
