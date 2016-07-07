<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Category Section
            $table->boolean('isTeam');
            $table->tinyInteger('teamSize');
            $table->tinyInteger('fightDuration');
            $table->boolean('hasRoundRobin');
            $table->tinyInteger('roundRobinWinner');
            $table->boolean('hasEncho');
            $table->tinyInteger('enchoQty');
            $table->tinyInteger('enchoDuration');
            $table->boolean('hasHantei');
            $table->smallInteger('cost');
            $table->string('slug')->nullable();
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
