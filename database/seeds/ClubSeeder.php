<?php

use App\Association;
use App\Club;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class ClubSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return  void
     */

    public function run()
    {
        $associations = Association::all()->pluck('id')->toArray();

        Club::truncate();
        $faker = Faker\Factory::create();

        Club::create([
            'name' => 'core.no_club',
            'president_id' => '1',
            'association_id' => '1']);

        $naucali_presidente = factory(User::class)->create(
            ['name' => 'naucali_President',
                'email' => 'naucali@aikem.com',
                'role_id' => Config::get('constants.ROLE_CLUB_PRESIDENT'),
                'password' => bcrypt('naucali'),
                'verified' => 1,
                'country_id' => 484,
                'federation_id' => 37,
                'association_id' => 7,
                'club_id' => 2,
            ]);

        try {
            factory(Club::class)->create(
                ['association_id' => 7,
                    'president_id' => $naucali_presidente->id,
                    'name' => 'Naucali'
                ]);
        } catch (Exception $e) {

        }

        try {
            factory(Club::class)->create(
                ['association_id' => 8,
                    'name' => 'UNAM'
                ]);

        } catch (Exception $e) {

        }
        try {
            factory(Club::class)->create(
                ['association_id' => 12,
                    'name' => 'Zacatenco'
                ]);

        } catch (Exception $e) {

        }

        try {
            factory(Club::class, 5)->create(['association_id' => 7]);
        } catch (Exception $e) {
        }
        try {
            factory(Club::class, 5)->create(['association_id' => $faker->randomElement($associations)]);
        } catch (Exception $e) {
        }


        $this->command->info('Clubs Seeded!');
    }
}
