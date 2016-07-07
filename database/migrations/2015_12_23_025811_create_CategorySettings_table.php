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
            $table->tinyInteger('teamSize')->nullable(); // Default is null
            $table->tinyInteger('teamReserve')->nullable(); // Default is null
            $table->tinyInteger('fightingAreas')->unsigned()->nullable()->default(1);
            $table->text('fightDuration'); // Can't apply default because text
            $table->boolean('hasRoundRobin')->default(1);
            $table->boolean('roundRobinGroupSize')->default(3);
            $table->tinyInteger('roundRobinWinner'); // Number of Competitors that go to next level
            $table->tinyInteger('roundRobinDuration'); // Match Duration in preliminary round
            $table->boolean('hasEncho')->default(1);
            $table->tinyInteger('enchoQty');
            $table->text('enchoDuration');
            $table->boolean('hasHantei');
            $table->smallInteger('cost'); // Cost of competition
            $table->smallInteger('seedQuantity')->default(4);  // Competitors seeded in tree
            $table->smallInteger('hanteiLimit')->default(0); // 0 = none, 1 = 1/8, 2 = 1/4, 3=1/2, 4 = FINAL
            $table->smallInteger('enchoTimeLimitless')->default(0); // 0 = none, 1 = 1/8, 2 = 1/4, 3=1/2, 4 = FINAL
            $table->integer('limitByEntity')->unsigned()->nullable();

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
