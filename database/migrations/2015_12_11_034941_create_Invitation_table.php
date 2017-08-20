<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvitationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitation', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string ('code', 255);
            $table->string('email');
            $table->string('object_type'); // We can invite to tournaments, teams, etc.
            $table->integer('object_id')->unsigned()->index();

            $table->date('expiration');
            $table->boolean('active');
            $table->boolean('used')->default(False);
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
        setFKCheckOff();
        Schema::dropIfExists('invitation');
        setFKCheckOn();
    }
}
