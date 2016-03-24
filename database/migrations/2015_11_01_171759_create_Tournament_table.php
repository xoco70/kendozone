<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class CreateTournamentTable extends Migration {

	public function up()
	{
		Schema::create('tournament', function(Blueprint $table) {
			$table->increments('id');
            $table->Integer('user_id')->unsigned();
			$table->foreign('user_id')
					->references('id')
					->on('users')
					->onDelete('cascade');

			$table->string('name');
			$table->string('slug')->nullable();

			$table->date('dateIni');
			$table->date('dateFin');
            $table->date('registerDateLimit');
//            $table->smallInteger('cost')->unsigned()->nullable();
            $table->Integer('sport')->unsigned()->default(1); // Default is Kendo for now

//            $table->tinyInteger('teamSize')->unsigned()->default(6)->nullable(); // Max Competitors in each team

//            $table->boolean('hasRoundRobin')->default(true);
//            $table->tinyInteger('roundRobinWinner')->unsigned()->default(1); // How much competitor get out of round robin
//            $table->tinyInteger('fightDuration')->unsigned()->default(3);
//            $table->boolean('hasEncho')->default(true);
			$table->tinyInteger('type')->default(1); // 1= local, 2= state, 3= national, 4=continent, 5=world
            $table->boolean('mustPay');

            $table->string("venue");
            $table->string("latitude");
            $table->string("longitude");
			$table->integer("level_id")->unsigned()->default(1);
			$table->foreign('level_id')
					->references('id')
					->on('tournamentLevel');


//			$table->string('banner');
//			$table->string('PassingTeams');

//			$table->tinyInteger('type')->unsigned()->default(1)->nullable(); // Tournament type
//			$table->integer('ScoreWin');
//			$table->integer('ScoreDraw');
//			$table->integer('ScoreType');
//			$table->string('Diploma');
//			$table->string('Accreditation');

			$table->timestamps();
			$table->softDeletes();
			$table->engine = 'InnoDB';

		});
	}

	public function down()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::dropIfExists('tournament');
		Schema::dropIfExists('tournamentLevel');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}
}