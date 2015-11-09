<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupTable extends Migration {

	public function up()
	{
		Schema::create('Groups', function(Blueprint $table) {
			$table->increments('id');
            $table->string("name");
			$table->string("description");
			$table->integer("level");
			$table->timestamps();

		});
	}

	public function down()
	{
		Schema::drop('Group');
	}
}