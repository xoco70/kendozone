<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShinpanTable extends Migration {

	public function up()
	{
		Schema::create('Shinpan', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('userId')->unsigned();
			$table->integer('shiaiCategoryId')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('Shinpan');
	}
}