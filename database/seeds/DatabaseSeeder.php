<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        if (App::environment() === 'production') {
            exit('Te acabo de salvar el pellejo. Estas en produccion pend***.');
        }
        Model::unguard();
        //Seed the countries
        $this->call('CountriesSeeder');
        $this->command->info('Seeded the countries!');
        $this->call('GradeSeeder');
        $this->command->info('Seeded the grades!');
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(PermissionRoleSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->command->info('Seeded the Users!');
        $this->call('TournamentLevelSeeder');
        $this->command->info('Seeded the TournamentLevel!');
        $this->command->info('All tables seeded!');

        Model::reguard();
    }
}