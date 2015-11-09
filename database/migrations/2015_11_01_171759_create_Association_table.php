<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssociationTable extends Migration {

	public function up()
	{
		Schema::create('Association', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->unique();
//			$table->integer('adminId')->unsigned();
			$table->timestamps();
			$table->engine = 'InnoDB';

		});
	}

	public function down()
	{
		Schema::drop('Association');
	}
}