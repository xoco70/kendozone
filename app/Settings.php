<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';
    protected $fillable = ['cat_teamsize','cat_roundRobinWinner','cat_fightDuration','cat_hasRoundRobin','cat_hasEncho','cat_hasHantei'];
    public $timestamps = true;




}
