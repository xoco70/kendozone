<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGradeAccessTable extends Migration {

	public function up()
	{
		Schema::create('GroupsAccess', function(Blueprint $table) {
			$table->increments('id');
            $table->integer("groupId");
			$table->integer("moduleId");
			$table->string("accessData");
			$table->integer("level");
			$table->timestamps();

		});
	}

	public function down()
	{
		Schema::drop('GroupAccess');
	}
}