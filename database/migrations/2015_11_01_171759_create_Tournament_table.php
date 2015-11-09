<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTournamentTable extends Migration {

	public function up()
	{
		Schema::create('Tournament', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
            $table->date('tournamentDate');
            $table->date('registerDateLimit');
            $table->integer('placeId')->unsigned(); // Mandatory to know limits of shiaijo
            $table->tinyInteger('TeamSize')->unsigned()->default(6)->nullable(); // Max Competitors in each team
            $table->tinyInteger('FightingAreas')->unsigned()->nullable();
            $table->boolean('hasRoundRobin')->default(true);
            $table->tinyInteger('roundRobinWinner')->unsigned()->default(1); // How much competitor get out of round robin
            $table->tinyInteger('fightDuration')->unsigned()->default(3);
            $table->boolean('hasEncho')->default(true);
			$table->tinyInteger('type')->default(1); // 1= local, 2= state, 3= national, 4=continent, 5=world

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
		Schema::drop('Tournament');
	}
}