<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

class TournamentCategory extends Model
{
    protected $table = 'tournamentCategory';
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
