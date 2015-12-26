<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';
    protected $fillable = ['isTeam','teamSize','fightDuration','hasRoundRobin','roundRobinWinner','hasEncho','enchoQty','enchoDuration', 'hasHantei'];
    public $timestamps = true;


    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
