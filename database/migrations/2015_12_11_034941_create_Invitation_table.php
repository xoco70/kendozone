<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->text('code', 255);
            $table->string('email');
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
        Schema::drop('invitation');
    }
}
