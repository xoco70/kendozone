<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        if (App::environment() === 'production') {
            exit('Te acabo de salvar el pellejo. Estas en produccion pend***.');
        }
        Model::unguard();
        //Seed the countries
        $this->command->info('Seeded the countries!');

        switch (DB::getDriverName()) {
            case 'mysql':
                DB::statement('SET FOREIGN_KEY_CHECKS=0');
                break;
            case 'sqlite':
                DB::statement('PRAGMA foreign_keys = OFF');
                break;
        }

        DB::table('users')->truncate();


        $this->call(CountriesSeeder::class);
        $this->call(VenueSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(RoleSeeder::class);

        $this->call(UserSeeder::class);
//        $this->call(PermissionSeeder::class);
//        $this->call(PermissionRoleSeeder::class);
//        $this->call(UserRoleSeeder::class);
        $this->call(TournamentLevelSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(TournamentSeeder::class);

        $this->call(FederationSeeder::class);
        $this->call(AssociationSeeder::class);
        $this->call(ClubSeeder::class);

        $this->command->info('All tables seeded!');


        switch (DB::getDriverName()) {
            case 'mysql':
                DB::statement('SET FOREIGN_KEY_CHECKS=1');
                break;
            case 'sqlite':
                DB::statement('PRAGMA foreign_keys = ON');
                break;
        }
        Model::reguard();
    }
}