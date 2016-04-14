<?php

use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_role')->truncate();


//        $adminRole = Role::find('3');
//        $userRole = Role::find('5');
//
//
//        $CanEditProfile = Permission::find(1);
//        $CanDeleteProfile = Permission::find(2);
//        $CanChangeSettings = Permission::find(3);
//        $CanAccessDashboard = Permission::find(4);
//        $CanSeeTournaments = Permission::find(5);
//        $CanCreateTournament = Permission::find(6);
//        $CanEditTournament = Permission::find(7);
//        $CanDeleteTournament = Permission::find(8);
//        $CanSeePlaces = Permission::find(9);
//        $CanCreatePlace = Permission::find(10);
//        $CanEditPlace = Permission::find(11);
//        $CanDeletePlace = Permission::find(12);
//        $CanRegisterUser = Permission::find(13);
//        $CanInviteCompetitor = Permission::find(14);
//        $CanBanCompetitor = Permission::find(15);
//        $CanSeeStatistics = Permission::find(16);
//        $CanSeeCompetitor = Permission::find(17);
//        $CanSeeGroup = Permission::find(18);
//        $CanSeeLogs = Permission::find(19);
//        $CanDeleteAccount = Permission::find(20);
//        $CanChangeRole = Permission::find(21);

        // Assign the roles to the users

//        $adminRole->givePermissionTo($CanEditProfile);
//        $adminRole->givePermissionTo($CanDeleteProfile);
//        $adminRole->givePermissionTo($CanChangeSettings);
//        $adminRole->givePermissionTo($CanAccessDashboard);
//        $adminRole->givePermissionTo($CanSeeTournaments);
//        $adminRole->givePermissionTo($CanCreateTournament);
//        $adminRole->givePermissionTo($CanEditTournament);
//        $adminRole->givePermissionTo($CanDeleteTournament);
//        $adminRole->givePermissionTo($CanSeePlaces);
//        $adminRole->givePermissionTo($CanCreatePlace);
//        $adminRole->givePermissionTo($CanEditPlace);
//        $adminRole->givePermissionTo($CanDeletePlace);
//        $adminRole->givePermissionTo($CanRegisterUser);
//        $adminRole->givePermissionTo($CanInviteCompetitor);
//        $adminRole->givePermissionTo($CanBanCompetitor);
//        $adminRole->givePermissionTo($CanChangeRole);
//        $adminRole->givePermissionTo($CanSeeStatistics);
//
//
//        $userRole->givePermissionTo($CanEditProfile);
//        $userRole->givePermissionTo($CanDeleteProfile);
//        $userRole->givePermissionTo($CanChangeSettings);
//        $userRole->givePermissionTo($CanAccessDashboard);
//        $userRole->givePermissionTo($CanSeeTournaments);
//        $userRole->givePermissionTo($CanSeeStatistics);





        $this->command->info('Permission assigned to roles seeded!');
    }
}
