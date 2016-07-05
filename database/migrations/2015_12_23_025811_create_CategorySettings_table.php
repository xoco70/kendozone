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
            $table->tinyInteger('teamSize')->default(5);
            $table->tinyInteger('fightingAreas')->unsigned()->nullable()->default(1);
            $table->text('fightDuration')->default('03:00');
            $table->boolean('hasRoundRobin')->default(1);
            $table->tinyInteger('roundRobinWinner');
            $table->boolean('hasEncho')->default(1);
            $table->tinyInteger('enchoQty');
            $table->text('enchoDuration')->default('02:00');
            $table->boolean('hasHantei');
            $table->smallInteger('cost');
            $table->smallInteger('seedQuantity')->default(4);

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
