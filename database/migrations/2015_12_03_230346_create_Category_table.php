<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Schema::create('category_tournament', function (Blueprint $table) {

            $table->integer('tournament_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();

            $table->primary(array('tournament_id', 'category_id'));
            $table->foreign('tournament_id')
                ->references('id')
                ->on('tournament')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('category')
                ->onDelete('cascade');

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

        Schema::dropIfExists('category_tournament');
        Schema::dropIfExists('category');


    }
}
