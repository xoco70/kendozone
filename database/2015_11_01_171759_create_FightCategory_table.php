<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShiaiCategoryTable extends Migration {

	public function up()
	{
		Schema::create('ShiaiCategory', function(Blueprint $table) {
			$table->increments('id');
			$table->string('category');
			$table->integer('tournamentId')->unsigned();
			$table->timestamps();

		});
	}

	public function down()
	{
		Schema::drop('ShiaiCategory');
	}
}