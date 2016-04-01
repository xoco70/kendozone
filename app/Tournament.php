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
        'dateIni',
        'dateFin',
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
            $tournament->invites()->delete();

        });
        static::restoring(function ($tournament) {

            foreach ($tournament->categoryTournaments()->withTrashed()->get() as $ct) {
                $ct->restore();
            }

        });

    }

    /**
     * A tournament is owned by a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * Get All Tournaments levels
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function level()
    {
        return $this->belongsTo('App\TournamentLevel', 'level_id', 'id');
    }

    /**
     * Get All categories available
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */


    // We can use $tournament->categories()->attach(id);
    // Or         $tournament->categories()->sync([1, 2, 3]);
    public function categories()
    {
        return $this->belongsToMany('App\Category')
            ->withPivot('id')
            ->withTimestamps();
    }

    /**
     * Get All categoriesTournament that belongs to a tournament
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoryTournaments()
    {
        return $this->hasMany(CategoryTournament::class);
    }


    /**
     * Get All categoriesSettings that belongs to a tournament
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function categorySettings()
    {
        return $this->hasManyThrough('App\CategorySettings', 'App\CategoryTournament');
    }

    /**
     * Get All competitors that belongs to a tournament
     * @param null $CategoryTournamentId
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function competitors($CategoryTournamentId = null)
    {
        return $this->hasManyThrough('App\CategoryTournamentUser', 'App\CategoryTournament');
    }


    /**
     * Get all Invitations that belongs to a tournament
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invites()
    {
        return $this->hasMany(Invite::class);

    }

    /**
     * @return mixed
     */
//    public function settings()
//    {
//        //TODO Should use hasManyThrough
//        $arrTc = CategoryTournament::select('id')->where('tournament_id', $this->id)->get();
//        $settings = CategorySettings::whereIn('category_tournament_id', $arrTc)->get();
//        return $settings;
//    }


    /**
     * Get All categoriesTournament that belongs to a tournament
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
//    public function tournament_categories()
//    {
//        return $this->belongsToMany('App\CategoryTournament', 'category_tournament');
//    }

//    public function categories_user()
//    {
//        return $this->belongsToMany('App\CategoryTournament', 'category_tournament_user', 'user_id', 'category_tournament_id')
//            ->withTimestamps();
//    }


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

    public function setDateIniAttribute($date)
    {
        $this->attributes['dateIni'] = Carbon::createFromFormat('Y-m-d', $date);
    }

    public function setDateFinAttribute($date)
    {
        $this->attributes['dateFin'] = Carbon::createFromFormat('Y-m-d', $date);
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