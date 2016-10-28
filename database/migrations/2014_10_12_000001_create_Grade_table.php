<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGradeTable extends Migration {

	public function up()
	{
		Schema::create('grade', function(Blueprint $table) {
			$table->increments('id');
            $table->string("name")->unique();
            $table->tinyInteger("order");
			$table->timestamps();
			$table->engine = 'InnoDB';
		});
	}

	public function down()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::dropIfExists('grade');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}
}