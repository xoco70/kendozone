<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFK extends Migration
{
    /**
     * Here goes all the extra FK
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->foreign('federation_id')
                ->references('id')
                ->on('federation')
                ->onUpdate('cascade');

            $table->foreign('association_id')
                ->references('id')
                ->on('association')
                ->onUpdate('cascade');

            $table->foreign('club_id')
                ->references('id')
                ->on('club')
                ->onUpdate('cascade');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropForeign('users_club_id_foreign');
            $table->dropForeign('users_association_id_foreign');
            $table->dropForeign('users_federation_id_foreign');

        });

    }
}
