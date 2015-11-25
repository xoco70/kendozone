<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTournamentLevelTable extends Migration {

	public function up()
	{
		Schema::create('tournamentLevel', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->engine = 'InnoDB';



		});
	}

	public function down()
	{
		Schema::drop('tournamentLevel');
	}
}