<?php

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        if (! $this->confirmToProceed()) {
            return;
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
        $this->call(TournamentLevelSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(TournamentSeeder::class);

        $this->call(FederationSeeder::class);
        $this->call(AssociationSeeder::class);
        $this->call(ClubSeeder::class);
        $this->call(CompetitorSeeder::class);

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


    public function confirmToProceed($warning = 'Application In Production!', $callback = null)
    {
        $shouldConfirm = $callback instanceof Closure ? call_user_func($callback) : $callback;

        if ($shouldConfirm) {
            if ($this->option('force')) {
                return true;
            }

            $this->comment(str_repeat('*', strlen($warning) + 12));
            $this->comment('*     '.$warning.'     *');
            $this->comment(str_repeat('*', strlen($warning) + 12));
            $this->output->writeln('');

            $confirmed = Command::confirm('Do you really wish to run this command?');

            if (! $confirmed) {
                $this->comment('Command Cancelled!');

                return false;
            }
        }

        return true;
    }
}