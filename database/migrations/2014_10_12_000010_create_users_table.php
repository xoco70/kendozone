<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->string('slug')->unique();
            $table->integer('role_id')->unsigned()->default(Config::get('constants.ROLE_USER'));
            $table->string('email')->unique();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();

            $table->string('password', 60);

            // FK is definded in create_FK migration
            $table->integer('federation_id')->nullable()->unsigned();
            $table->integer('association_id')->nullable()->unsigned();
            $table->integer('club_id')->nullable()->unsigned();
            $table->integer('grade_id')->unsigned()->default(1);

            $table->string('city')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->integer('country_id')->unsigned()->index();

            $table->string('gender')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('verified')->default(false);
            $table->string('token')->nullable();
            $table->string('provider');
            $table->string('provider_id')->unique()->nullable();
            $table->string('locale', 5)->default('en');



            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onUpdate('cascade');

            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onUpdate('cascade');

            $table->foreign('grade_id')
                ->references('id')
                ->on('grade')
                ->onUpdate('cascade');

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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('users');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
