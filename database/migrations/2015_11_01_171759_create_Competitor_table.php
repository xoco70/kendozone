<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitorTable extends Migration {

	public function up()
	{
		Schema::create('competitor', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('surname');
			$table->integer('user_id')->unsigned();
			$table->integer('club_id')->unsigned();
//			$table->string('picture');
			$table->timestamps();
			$table->engine = 'InnoDB';

			$table->foreign('user_id')
				->references('id')
				->on('users')
				->onDelete('cascade');

//			$table->foreign('club_id')
//					->references('id')
//					->on('club')
//					->onDelete('cascade');

//
//			$table->foreign('shiaiCategoryId')
//					->references('id')
//					->on('ShiaiCategory')
//					->onDelete('cascade');
//
//
//			$table->foreign('tournamentId')
//					->references('id')
//					->on('Tournament')
//					->onDelete('cascade');

		});
	}

	public function down()
	{
		Schema::drop('competitor');
	}
}