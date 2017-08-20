<?php

use Illuminate\Database\Migrations\Migration;

class CreateLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function ($table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->index();
            $table->string('owner_type');
            $table->integer('owner_id')->index();
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->string('type');
            $table->string('route');
            $table->string('ip');
            $table->timestamps();
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
        Schema::drop('logs');
        setFKCheckOn();
    }
}
