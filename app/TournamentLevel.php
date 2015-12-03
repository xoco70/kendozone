<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

class TournamentLevel extends Model
{

    protected $table = 'tournamentLevel';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
    ];
    public function getNameAttribute($name)
    {

        return Lang::get($name);
    }

}