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
        'placeId',
        'teamSize',
        'fightingAreas',
        'hasRoundRobin',
        'roundRobinWinner',
        'fightDuration',
        'hasEncho',
        'type'
    ];

    protected $dates = ['tournamentDate', 'registerDateLimit'];

    public function place()
    {
        return $this->hasOne('Place');
    }

    public function shiaiCategory()
    {
        return $this->hasMany('ShiaiCategory');
    }

    public function geTournamentDateAttribute($date)
    {
        return $date == "0000-00-00 00:00:00" ? "0000-00-00 00:00:00" : $date;
    }

    public function getLimitRegisterDateAttribute($date)
    {
        return $date == "0000-00-00 00:00:00" ? "0000-00-00 00:00:00" : $date;
    }

    public function setTournamentDateAttribute($date)
    {
        $this->attributes['tournamentDate'] = Carbon::createFromFormat('Y-m-d', $date);
    }

    public function setLimitRegisterDateAttribute($date)
    {
        $this->attributes['registerDateLimit'] = Carbon::createFromFormat('Y-m-d', $date);
    }

//	public function setplaceId($id){
//		$this->attributes['placeId'] = $id;
//	}

    public function scopeIsFuture($query)
    {
        $query->where('tournamentDate', '>=', Carbon::now());

    }

    public function scopeIsPast($query)
    {
        $query->where('tournamentDate', '<=', Carbon::now());

    }

    public function scopeIsTooLate($query)
    {
        $query->where('registerDateLimit', '<=', Carbon::now());

    }

    public function scopeIsOnTime($query)
    {
        $query->where('registerDateLimit', '>=', Carbon::now());

    }

}