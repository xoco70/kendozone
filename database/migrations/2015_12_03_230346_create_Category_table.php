<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->string('gender');
            $table->integer('isTeam')->unsigned()->default(0);
            $table->integer('ageCategory')->unsigned()->default(0); // 0 = none, 1 = child, 2= teenager, 3 = adult, 4 = master
            $table->integer('ageIni')->unsigned()->default(0);
            $table->integer('ageFin')->unsigned()->default(0);
            $table->integer('gradeIni')->unsigned()->default(1);
            $table->integer('gradeFin')->unsigned()->default(1);
            $table->foreign('gradeIni')
                ->references('id')
                ->on('grade');
            $table->foreign('gradeFin')
                ->references('id')
                ->on('grade');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Schema::create('category_tournament', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tournament_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();
            $table->unique(array('tournament_id', 'category_id'));

            $table->foreign('tournament_id')
                ->references('id')
                ->on('tournament')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('category')
                ->onDelete('cascade');


            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';


        });


        Schema::create('category_tournament_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_tournament_id')->unsigned()->index();
            $table->foreign('category_tournament_id')
                ->references('id')
                ->on('category_tournament')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unique(array('category_tournament_id', 'user_id'));

            $table->boolean('confirmed');

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
        Schema::dropIfExists('category_tournament_user');
        Schema::dropIfExists('category_tournament');
        Schema::dropIfExists('category');


    }
}
