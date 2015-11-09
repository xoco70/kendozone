<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	public function run()
	{
		Model::unguard();
		//Seed the countries
		$this->call('CountriesSeeder');
		$this->command->info('Seeded the countries!');
		$this->call('GradeSeeder');
		$this->command->info('Seeded the grades!');
		$this->call(SentinelRoleSeeder::class);
	        $this->call(SentinelUserSeeder::class);
	        $this->call(SentinelUserRoleSeeder::class);

	        $this->command->info('All tables seeded!');

	        Model::reguard();
	}
}