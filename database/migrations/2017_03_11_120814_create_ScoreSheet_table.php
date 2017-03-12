<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoreSheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scoresheets', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->integer('championship_id')->unsigned();
            $table->integer('fighters_group_id')->unsigned();

            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';

//            $table->unique(['name','deleted_at'], 'club_name_unique');

            $table->foreign('championship_id')
                ->references('id')
                ->on('championship')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('fighters_group_id')
                ->references('id')
                ->on('fighters_groups')
                ->onUpdate('cascade')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('scoresheets');

    }
}
