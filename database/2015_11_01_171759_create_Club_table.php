<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClubTable extends Migration {

	public function up()
	{
		Schema::create('Club', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name'); // Name of the club
			$table->integer('asocId')->unsigned(); // Association Id
            $table->string('mail');
            $table->string('phone');
            $table->string('city');
            $table->string('web');
            $table->string('adress');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('Club');
	}
}
