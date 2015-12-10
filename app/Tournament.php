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
        'level_id',

    ];

    protected $dates = ['tournamentDate', 'registerDateLimit'];

//    public function place()
//    {
//        return $this->hasOne('Place');
//    }

    /**
     * A tournament is owned by a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

//    public function level()
//    {
//        return $this->hasOne('App\TournamentLevel');
//    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */


    // We can use $tournament->categories()->attach(id);
    // Or         $tournament->categories()->sync([1, 2, 3]);
    // I'm not sure about the name
    public function categories()
    {
        return $this->belongsToMany('App\Category')->withTimestamps();
    }

    public function getCategoryList()
    {
        return $this->categories->lists('id')->all();
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


//    public function setMustPayAttribute($mustPay)
//    {
//
//        if ($mustPay == "on") {
//            dd($mustPay);
//            $this->attributes['mustPay'] = 1;
//        }
//    }
//    public function setTypeAttribute($type)
//    {
//        if ($type == "on")
//            $this->attributes['type'] = 1;
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