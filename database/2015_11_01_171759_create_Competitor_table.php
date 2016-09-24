<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompetitorTable extends Migration {

	public function up()
	{
		Schema::create('competitor', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('surname');
			$table->integer('user_id')->unsigned();
			$table->integer('club_id')->unsigned();
			$table->timestamps();
			$table->engine = 'InnoDB';

			$table->foreign('user_id')
				->references('id')
				->on('users')
				->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::dropIfExists('competitor');
	}
}