<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_settings', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('tournament_id');
            $table->integer('category_id');
            // General Section

            // Category Section
            $table->tinyInteger('teamsize');
            $table->tinyInteger('roundRobinWinner');
            $table->tinyInteger('fightDuration');
            $table->tinyInteger('hasRoundRobin');
            $table->tinyInteger('hasEncho');
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
        Schema::dropIfExists('category_settings');
    }
}
