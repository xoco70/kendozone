<?php

namespace App;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class Tournament extends Model implements SluggableInterface
{
    use SoftDeletes;
    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'name',
        'save_to' => 'slug',
    ];
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
    protected $dates = ['date', 'registerDateLimit', 'created_at', 'updated_at', 'deleted_at'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($tournament) {
            foreach ($tournament->categoryTournaments as $ct) {
                $ct->delete();
            }

        });
        static::restoring(function ($tournament) {

            foreach ($tournament->categoryTournaments()->withTrashed()->get() as $ct) {
                $ct->restore();
            }

        });

    }

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
        return $this->belongsTo('App\User', 'user_id', 'id');
    }


    //TODO Change this method por tcu() relation
    public function competitors($CategoryTournamentId = null)
    {
//        User::join('category_tournament_user', 'user.id','user_id' )
        $users = DB::table('users')
            ->join('category_tournament_user as ctu', 'ctu.user_id', '=', 'users.id')
            ->join('category_tournament as ct', 'ctu.category_tournament_id', '=', 'ct.id')
            ->join('category', 'ct.category_id', '=', 'category.id')
            ->where('ct.tournament_id', '=', $this->id);

        if ($CategoryTournamentId != null)
            $users->where('ct.id', '=', $CategoryTournamentId);

        $users = $users->select('users.id', 'ct.tournament_id', 'users.name', 'email', 'avatar', 'country_id',
            'category.id as cat_id', 'category.name as cat_name', 'ct.tournament_id', 'ct.id as tcId', 'ctu.confirmed', 'ctu.id as ctuId')
            ->orderBy('ct.id', 'ASC')
            ->orderBy('users.email', 'ASC')
            ->get();
        $users = User::hydrate($users);
        return $users;
    }

//    public function deleteUser($categoryTournamentId, $userId)
//    {
//
//
//    }


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

    public function categoryTournaments()
    {
        return $this->hasMany(CategoryTournament::class);
    }

    public function categorySettings()
    {
        return $this->hasMany(CategorySettings::class);

    }

    public function settings()
    {
        $arrTc = CategoryTournament::select('id')->where('tournament_id', $this->id)->get();
        $settings = CategorySettings::whereIn('category_tournament_id', $arrTc)->get();
        return $settings;
    }

//    public function ct(){
//        return $this->hasMany('App\CategoryTournament');
//    }


//    public function CategoryTournament()
//    {
//        return $this->belongsToMany('App\CategoryTournament', 'category_tournament', 'tournament_id', 'category_id');
//    }

    // We can use $tournament->category_user()->attach(id);
    // Or         $tournament->category_user()->sync([1, 2, 3]);
    // I'm not sure about the name

    public function tournament_categories()
    {
        return $this->belongsToMany('App\CategoryTournament', 'category_tournament');
    }

    public function categories_user()
    {
        return $this->belongsToMany('App\CategoryTournament', 'category_tournament_user', 'user_id', 'category_tournament_id')
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

    public function isOpen()
    {
        return $this->type == 1;
    }

    public function needsInvitation()
    {
        return $this->type == 0;
    }
//    public function getCategoriesWithSettings()
//    {
//        $categories = DB::table('category_tournament')
//            ->join('category as cat', 'cat.id', '=', 'category_tournament.category_id')
//            ->leftJoin('category_settings as cs', 'cs.category_tournament_id', '=', 'category_tournament.id')
//            ->where('category_tournament.tournament_id', '=', $this->id)
//            ->select('category_tournament.*', 'cat.name', 'cs.*')
//            ->get();
//        return $categories;
//    }
    public function getRouteKeyName()
    {
        return 'slug';
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