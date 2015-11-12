<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TournamentType extends Model
{

    protected $table = 'tournamentType';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
    ];

}