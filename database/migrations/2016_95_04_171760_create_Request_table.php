<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestTable extends Migration
{
    /**
     * Table for requesting thing ( The opposite of inviting ).
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('user_id');
            $table->string('object_type'); // We can invite to tournaments, teams, etc.
            $table->integer('object_id')->unsigned();
            $table->boolean('used')->default(false);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        setFKCheckOff();
        Schema::dropIfExists('request');
        setFKCheckOn();
    }
}
