<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlaceTable extends Migration {

	public function up()
	{
		Schema::create('place', function(Blueprint $table) {


		});
	}

	public function down()
	{
		Schema::drop('place');
	}
}