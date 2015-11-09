<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlaceTable extends Migration {

	public function up()
	{
		Schema::create('Place', function(Blueprint $table) {
			$table->increments('id');
            $table->string("name");
            $table->string("coords");
            $table->string("city");
            $table->string("state");
            $table->integer("countryId");
			$table->timestamps();
			$table->engine = 'InnoDB';

		});
	}

	public function down()
	{
		Schema::drop('Place');
	}
}