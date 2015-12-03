<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{

    protected $table = 'tournament';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'tournamentDate',
        'registerDateLimit',
        'sport',
        'cost',
        'mustPay',
        'place',
        'latitude',
        'longitude',
        'teamSize',
        'fightingAreas',
        'hasRoundRobin',
        'roundRobinWinner',
        'fightDuration',
        'hasEncho',
        'type',

    ];

    protected $dates = ['tournamentDate', 'registerDateLimit'];

//    public function place()
//    {
//        return $this->hasOne('Place');
//    }

    public function shiaiCategory()
    {
        return $this->hasMany('ShiaiCategory');
    }

    public function getTournamentDateAttribute($date)
    {
        return $date;
    }

    public function getRegisterDateLimitAttribute($date)
    {
        return $date;
    }

    public function setTournamentDateAttribute($date)
    {
        $this->attributes['tournamentDate'] = Carbon::createFromFormat('Y-m-d', $date);
    }

    public function setLimitRegisterDateAttribute($date)
    {
        $this->attributes['registerDateLimit'] = Carbon::createFromFormat('Y-m-d', $date);
    }


//    public function sethasRoundRobin($hasRoundRobin)
//    {
//        if ($hasRoundRobin == "on")
//            $this->attributes['$hasRoundRobin'] = 1;
//    }
//    public function sethasEncho($hasEncho)
//    {
//        if ($hasEncho == "on")
//            $this->attributes['$hasEncho'] = 1;
//    }



//	public function setplaceId($id){
//		$this->attributes['placeId'] = $id;
//	}

//    public function scopeIsFuture($query)
//    {
//        $query->where('tournamentDate', '>=', Carbon::now());
//
//    }
//
//    public function scopeIsPast($query)
//    {
//        $query->where('tournamentDate', '<=', Carbon::now());
//
//    }
//
//    public function scopeIsTooLate($query)
//    {
//        $query->where('registerDateLimit', '<=', Carbon::now());
//
//    }
//
//    public function scopeIsOnTime($query)
//    {
//        $query->where('registerDateLimit', '>=', Carbon::now());
//
//    }

}