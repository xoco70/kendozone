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
            $table->integer('tournament_id')->unsigned();
            $table->foreign('tournament_id')
                ->references('id')
                ->on('tournament')
                ->onDelete('cascade');

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')
                ->references('id')
                ->on('category')
                ->onDelete('cascade');

            // Foreign key on the 2 fields in pivot table
            $table
                ->foreign(array('category_id', 'tournament_id'))
                ->references(array('category_id', 'tournament_id'))
                ->on('category_tournament');


            $table->unique(array('tournament_id', 'category_id'));
            // General Section

            // Category Section
            $table->tinyInteger('isTeam');
            $table->tinyInteger('teamSize');
            $table->smallInteger('fightDuration');
            $table->tinyInteger('hasRoundRobin');
            $table->tinyInteger('roundRobinWinner');
            $table->tinyInteger('hasEncho');
            $table->tinyInteger('enchoQty');
            $table->smallInteger('enchoDuration');
            $table->tinyInteger('hasHantei');
            $table->smallInteger('cost');

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
