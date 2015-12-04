<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTournamentTable extends Migration {

	public function up()
	{
		Schema::create('tournament', function(Blueprint $table) {
			$table->increments('id');
            $table->bigInteger('user_id');
			$table->string('name');
            $table->date('tournamentDate');
            $table->date('registerDateLimit');
            $table->tinyInteger('cost');
            $table->tinyInteger('sport')->unsigned()->default(1); // Default is Kendo for now

            $table->tinyInteger('teamSize')->unsigned()->default(6)->nullable(); // Max Competitors in each team
            $table->tinyInteger('fightingAreas')->unsigned()->nullable();
            $table->boolean('hasRoundRobin')->default(true);
            $table->tinyInteger('roundRobinWinner')->unsigned()->default(1); // How much competitor get out of round robin
            $table->tinyInteger('fightDuration')->unsigned()->default(3);
            $table->boolean('hasEncho')->default(true);
			$table->tinyInteger('type')->default(1); // 1= local, 2= state, 3= national, 4=continent, 5=world
            $table->boolean('mustPay');

            $table->string("place");
            $table->string("latitude");
            $table->string("longitude");

//			$table->string('banner');
//			$table->string('PassingTeams');

//			$table->tinyInteger('type')->unsigned()->default(1)->nullable(); // Tournament type
//			$table->integer('ScoreWin');
//			$table->integer('ScoreDraw');
//			$table->integer('ScoreType');
//			$table->string('Diploma');
//			$table->string('Accreditation');


			$table->timestamps();
			$table->engine = 'InnoDB';



		});
	}

	public function down()
	{
		Schema::drop('tournament');
	}
}