<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Symfony\Component\Console\Output\ConsoleOutput;

class CreateRolesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        $output = new ConsoleOutput();
//        $output->writeln('Converting of 50000');


        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';

        });
//        Schema::create('role_user', function (Blueprint $table) {
//            $table->integer('role_id')->unsigned();
//            $table->integer('user_id')->unsigned();
//            $table->foreign('role_id')
//                ->references('id')
//                ->on('roles')
//                ->onDelete('cascade');
//            $table->foreign('user_id')
//                ->references('id')
//                ->on('users')
//                ->onDelete('cascade');
//            $table->primary(['role_id', 'user_id']);
//        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::drop('role_user');
        Schema::dropIfExists('roles');
    }
}