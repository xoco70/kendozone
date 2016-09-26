<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClubTable extends Migration {

	public function up()
	{
		Schema::create('club', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->integer('association_id')->unsigned();
			$table->integer('president_id')->nullable()->unsigned();
			$table->string('address')->nullable();
			$table->string('phone')->nullable();
			$table->string('website')->nullable();
			
//			$table->integer('stateId')->unsigned();
			$table->timestamps();
			$table->softDeletes();
			$table->engine = 'InnoDB';

			$table->unique(['name','deleted_at'], 'club_name_unique');
            $table->unique(['president_id'], 'club_president_unique');

			$table->foreign('president_id')
				->references('id')
				->on('users')
				->onUpdate('cascade')
				->onDelete('cascade');

			$table->foreign('association_id')
				->references('id')
				->on('association')
				->onUpdate('cascade')
				->onDelete('cascade');

		});
	}

	public function down()
	{
		Schema::drop('club');
	}
}