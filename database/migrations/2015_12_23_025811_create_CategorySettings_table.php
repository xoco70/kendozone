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
            $table->integer('category_tournament_id')->unsigned()->unique();
            $table->foreign('category_tournament_id')
                ->references('id')
                ->on('category_tournament')
                ->onDelete('cascade');


            // Category Section
            $table->tinyInteger('isTeam');
            $table->tinyInteger('teamSize');
            $table->tinyInteger('fightingAreas')->unsigned()->nullable();
            $table->text('fightDuration');
            $table->tinyInteger('hasRoundRobin');
            $table->tinyInteger('roundRobinWinner');
            $table->tinyInteger('hasEncho');
            $table->tinyInteger('enchoQty');
            $table->text('enchoDuration');
            $table->tinyInteger('hasHantei');
            $table->smallInteger('cost');

            $table->timestamps();
            $table->softDeletes();
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
