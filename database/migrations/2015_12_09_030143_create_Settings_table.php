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
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            // Category Section
            $table->tinyInteger('isTeam');
            $table->tinyInteger('teamSize');
            $table->tinyInteger('fightDuration');
            $table->tinyInteger('hasRoundRobin');
            $table->tinyInteger('roundRobinWinner');
            $table->tinyInteger('hasEncho');
            $table->tinyInteger('enchoQty');
            $table->tinyInteger('enchoDuration');
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
