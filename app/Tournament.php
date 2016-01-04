<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Tournament extends Model
{

    protected $table = 'tournament';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'date',
        'registerDateLimit',
        'sport',
        'cost',
        'mustPay',
        'venue',
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

    protected $dates = ['date', 'registerDateLimit'];

//    public function place()
//    {
//        return $this->hasOne('Place');
//    }

    /**
     * A tournament is owned by a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id','id');
    }

    public function competitors()
    {
//        User::join('category_tournament_user', 'user.id','user_id' )



//        return $this->belongsToMany('App\User', 'category_tournament', 'category_tournament_id', 'user_id' )
//            ->withPivot('confirmed')
//            ->withTimestamps();
    }

    public function level()
    {
        return $this->belongsTo('App\TournamentLevel', 'level_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */


    // We can use $tournament->categories()->attach(id);
    // Or         $tournament->categories()->sync([1, 2, 3]);
    // I'm not sure about the name
    public function categories()
    {
        return $this->belongsToMany('App\Category')
                    ->withPivot('id')
                    ->withTimestamps();
    }

    public function settings($tournamentId)
    {
        $arrTc = TournamentCategory::select('id')->where('tournament_id',$tournamentId)->get();
        $settings = CategorySettings::whereIn('category_tournament_id',$arrTc)->get();
        return $settings;
    }

//    public function tournamentCategory()
//    {
//        return $this->belongsToMany('App\TournamentCategory', 'category_tournament', 'tournament_id', 'category_id');
//    }

    // We can use $tournament->category_user()->attach(id);
    // Or         $tournament->category_user()->sync([1, 2, 3]);
    // I'm not sure about the name

    public function tournament_categories()
    {
        return $this->belongsToMany('App\TournamentCategory','category_tournament');
    }

    public function categories_user()
    {
        return $this->belongsToMany('App\TournamentCategory','category_tournament_user', 'user_id', 'category_tournament_id')
            ->withTimestamps();
    }



    public function getCategoryList()
    {
        return $this->categories->lists('id')->all();
    }


    public function getDateAttribute($date)
    {
        return $date;
    }

    public function getRegisterDateLimitAttribute($date)
    {
        return $date;
    }

    public function setDateAttribute($date)
    {
        $this->attributes['date'] = Carbon::createFromFormat('Y-m-d', $date);
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