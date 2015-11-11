<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TournamentType extends Model
{

    protected $table = 'tournamenTypet';
    public $timestamps = true;

    protected $fillable = [
        'name',
    ];

}