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
			$table->integer('userId')->unsigned();
			$table->integer('clubId')->unsigned();
			$table->string('picture');
			$table->timestamps();

			$table->foreign('userId')
				->references('id')
				->on('users')
				->onDelete('cascade');

			$table->foreign('clubId')
					->references('id')
					->on('club')
					->onDelete('cascade');

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