<?php
use App\Category;
use App\Federation;
use App\Grade;
use App\Role;
use App\User;
use App\TournamentLevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Webpatser\Countries\Countries;

class LocalInstallSeeder extends Seeder
{

    public function run()
    {
        Model::unguard();


        setFKCheckOff();

        if (Countries::count()==0)          $this->call(CountriesSeeder::class);
        if (Grade::count()==0)              $this->call(GradeSeeder::class);
        if (Role::count()==0)               $this->call(RoleSeeder::class);
        if (User::count()==0)               $this->call(UserSeeder::class);
        if (TournamentLevel::count()==0)    $this->call(TournamentLevelSeeder::class);
        if (Category::count()==0)           $this->call(CategorySeeder::class);
        if (Federation::count()==0)         $this->call(FederationSeeder::class);

        $this->command->info('All tables seeded!');
        setFKCheckOn();
        Model::reguard();
    }
}