<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeamTable extends Migration
{

    public function up()
    {
        Schema::create('Team', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shiaiCategoryId')->unsigned(); // A checar
            $table->integer('tournamentId')->unsigned();
            $table->integer('competitor1')->unsigned();
            $table->integer('competitor2')->unsigned();
            $table->integer('competitor3')->unsigned();
            $table->integer('competitor4')->unsigned();
            $table->integer('competitor5')->unsigned();
            $table->integer('competitor6')->unsigned();
            $table->timestamps();

            $table->foreign('tournamentId')
                ->references('id')
                ->on('Tournament')
                ->onDelete('cascade');

            $table->foreign('competitor1')
                ->references('id')
                ->on('Competitor')
                ->onDelete('cascade');

            $table->foreign('competitor2')
                ->references('id')
                ->on('Competitor')
                ->onDelete('cascade');

            $table->foreign('competitor3')
                ->references('id')
                ->on('Competitor')
                ->onDelete('cascade');

            $table->foreign('competitor4')
                ->references('id')
                ->on('Competitor')
                ->onDelete('cascade');

            $table->foreign('competitor5')
                ->references('id')
                ->on('Competitor')
                ->onDelete('cascade');

            $table->foreign('competitor6')
                ->references('id')
                ->on('Competitor')
                ->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::drop('Team');
    }
}