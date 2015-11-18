<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('permissions')->truncate();
        Permission::create(['name' => "CanEditProfile",'label' => '']);
        Permission::create(['name' => "CanDeleteProfile",'label' => '']);
        Permission::create(['name' => "CanChangeSettings",'label' => '']);
        Permission::create(['name' => "CanAccessDashboard",'label' => '']);

        Permission::create(['name' => "CanSeeTournaments",'label' => '']);
        Permission::create(['name' => "CanCreateTournament",'label' => '']);
        Permission::create(['name' => "CanEditTournament",'label' => '']);
        Permission::create(['name' => "CanDeleteTournament",'label' => '']);

        Permission::create(['name' => "CanSeePlaces",'label' => '']);
        Permission::create(['name' => "CanCreatePlace",'label' => '']);
        Permission::create(['name' => "CanEditPlace",'label' => '']);
        Permission::create(['name' => "CanDeletePlace",'label' => '']);

        Permission::create(['name' => "CanRegisterUser",'label' => '']);
        Permission::create(['name' => "CanInviteCompetitor",'label' => '']);
        Permission::create(['name' => "CanBanCompetitor",'label' => '']);
        Permission::create(['name' => "CanSeeStatistics",'label' => '']);
        Permission::create(['name' => "CanSeeCompetitor",'label' => '']);
        Permission::create(['name' => "CanSeeGroup",'label' => '']);
        Permission::create(['name' => "CanSeeLogs",'label' => '']);
        Permission::create(['name' => "CanDeleteAccount",'label' => '']);
        Permission::create(['name' => "CanChangeRole",'label' => '']);






        $this->command->info('Permissions seeded!');
    }
}
