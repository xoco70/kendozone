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
        Schema::table('users', function (Blueprint $table) {

            $table->string('slug')->unique()->default('');
            $table->integer('role_id')->unsigned()->default(Config::get('constants.ROLE_USER'));

            // FK is definded in create_FK migration
            $table->integer('federation_id')->nullable()->unsigned();
            $table->integer('association_id')->nullable()->unsigned();
            $table->integer('club_id')->nullable()->unsigned();
            $table->integer('grade_id')->unsigned()->default(1);

            $table->string('city')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->integer('country_id')->nullable()->unsigned()->index();

            $table->string('gender')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('verified')->default(false);
            $table->string('token')->nullable();
            $table->string('provider')->nullable();
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
        // Undo all fields
    }
}
