<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFederationTable extends Migration {

	public function up()
	{
		Schema::create('Federation', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->unique();
//			$table->integer('adminId')->unsigned();
			$table->integer('countryId');
			$table->timestamps();
			$table->engine = 'InnoDB';

		});
	}

	public function down()
	{
		Schema::drop('Federation');
	}
}