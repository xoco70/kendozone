<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class CreateTournamentTable extends Migration
{

    public function up()
    {
        Schema::table('tournament', function (Blueprint $table) {
            $table->foreign('level_id')
                ->references('id')
                ->on('tournamentLevel')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        setFKCheckOff();
        Schema::dropIfExists('tournament');
        Schema::dropIfExists('tournamentLevel');
        setFKCheckOn();
    }
}