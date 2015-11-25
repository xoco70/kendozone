<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TournamentLevel extends Model
{

    protected $table = 'tournamentLevel';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
    ];

}