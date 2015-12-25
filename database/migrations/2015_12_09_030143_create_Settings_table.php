<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            // General Section

            // Category Section
            $table->tinyInteger('isteam');
            $table->tinyInteger('teamsize');
            $table->tinyInteger('fightDuration');
            $table->tinyInteger('hasRoundRobin');
            $table->tinyInteger('roundRobinWinner');
            $table->tinyInteger('hasEncho');
            $table->tinyInteger('encho_qty');
            $table->tinyInteger('encho_duration');
            $table->tinyInteger('hasHantei');

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
        Schema::dropIfExists('settings');
    }
}
