<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
//        if (! $this->confirmToProceed()) {
//            return;
//        }
        Model::unguard();
        //Seed the countries
        $this->command->info('Seeded the countries!');

        setFKCheckOff();

        DB::table('users')->truncate();


        $this->call(CountriesSeeder::class);
        $this->call(VenueSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(RoleSeeder::class);

        $this->call(UserSeeder::class);
        $this->call(TournamentLevelSeeder::class);
        $this->call(CategorySeeder::class);
//        $this->call(TournamentSeeder::class);

        $this->call(FederationSeeder::class);
        $this->call(AssociationSeeder::class);
        $this->call(ClubSeeder::class);
//        $this->call(CompetitorSeeder::class);

        $this->command->info('All tables seeded!');
        setFKCheckOn();
        Model::reguard();
    }
}