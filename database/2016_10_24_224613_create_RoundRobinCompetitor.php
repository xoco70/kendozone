<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoundRobinCompetitor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('round_robin_competitor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('round_robin_id')->unsigned()->index();
            $table->foreign('round_robin_id')
                ->references('id')
                ->on('round_robin')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->integer('competitor_id')->unsigned()->index();
            $table->foreign('competitor_id')
                ->references('id')
                ->on('competitor')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unique(array('round_robin_id', 'competitor_id'));
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
        //
    }
}
