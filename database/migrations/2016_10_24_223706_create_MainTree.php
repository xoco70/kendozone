<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreliminaryTree extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tree', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('championship_id')->unsigned()->index();

            $table->integer('c1')->nullable()->unsigned()->index();
            $table->foreign('c1')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('c2')->nullable()->unsigned()->index();
            $table->foreign('c2')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->tinyInteger("area");
            $table->tinyInteger("order");
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('tree');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
