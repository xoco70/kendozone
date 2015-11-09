<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFightTable extends Migration {

	public function up()
	{
		Schema::create('Fight', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('competitorId1')->unsigned();
			$table->integer('competitorId2')->unsigned();
            $table->integer('fightArea')->unsigned();
//            $table->integer('tournamentId')->unsigned();
//            $table->integer('groupIndex')->unsigned();
//            $table->integer('tournamentGroup')->unsigned();
//            $table->integer('tournamentLevel')->unsigned();
            $table->integer('winner')->unsigned(); // -1-> Winner left team, 1-> Winner right team, 0-> Draw Game, 3-> Not finished',
			$table->integer('fightCategoryId')->unsigned();
			$table->timestamps();

            $table->foreign('competitorId1')
                ->references('id')
                ->on('Competitor')
                ->onDelete('cascade');

            $table->foreign('competitorId2')
                ->references('id')
                ->on('Competitor')
                ->onDelete('cascade');

            $table->foreign('fightCategoryId')
                ->references('id')
                ->on('FightCategoryId')
                ->onDelete('cascade');

		});
	}

	public function down()
	{
		Schema::drop('Fight');
	}
}