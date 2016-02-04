<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->integer('grade_id')->unsigned()->default(1);
            $table->foreign('grade_id')
                ->references('id')
                ->on('grade')
                ->onDelete('cascade');

//            $table->string('country')->nullable();
//            $table->string('countryCode')->nullable();
            $table->string('city')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();

            $table->integer('role_id')->unsigned()->default(3);
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');

            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('cascade');

            $table->string('avatar')->nullable();
            $table->boolean('verified')->default(false);
            $table->string('token')->nullable();
            $table->string('provider');
            $table->string('provider_id')->unique()->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
