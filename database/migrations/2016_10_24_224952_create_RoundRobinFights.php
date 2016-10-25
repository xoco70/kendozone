<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoundRobinFights extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('round_robin_fights', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('round_robin_id')->unsigned()->index();
            $table->integer('c1')->unsigned();
            $table->integer('c2')->unsigned();
            $table->tinyInteger("order");

            $table->foreign('round_robin_id')
                ->references('id')
                ->on('round_robin')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('c1')
                ->references('id')
                ->on('competitor')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('c2')
                ->references('id')
                ->on('competitor')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unique(array('c1', 'c2'));


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
