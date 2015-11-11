<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTournamentTypeTable extends Migration {

	public function up()
	{
		Schema::create('tournamentType', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->engine = 'InnoDB';



		});
	}

	public function down()
	{
		Schema::drop('tournamentType');
	}
}