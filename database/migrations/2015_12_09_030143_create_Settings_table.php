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
            $table->tinyInteger('cat_teamsize');
            $table->tinyInteger('cat_roundRobinWinner');
            $table->tinyInteger('cat_fightDuration');
            $table->tinyInteger('cat_hasRoundRobin');
            $table->tinyInteger('cat_hasEncho');
            $table->tinyInteger('cat_hasHantei');

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
