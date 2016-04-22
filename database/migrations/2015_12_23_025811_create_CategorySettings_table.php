<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
                ->onUpdate('cascade')
                ->on('category_tournament')
                ->onDelete('cascade');


            // Category Section
            $table->boolean('isTeam');
            $table->tinyInteger('teamSize');
            $table->tinyInteger('fightingAreas')->unsigned()->nullable();
            $table->text('fightDuration');
            $table->boolean('hasRoundRobin');
            $table->tinyInteger('roundRobinWinner');
            $table->boolean('hasEncho');
            $table->tinyInteger('enchoQty');
            $table->text('enchoDuration');
            $table->boolean('hasHantei');
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('category_settings');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
