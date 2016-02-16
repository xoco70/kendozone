<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryTournament extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'category_tournament';

    public $timestamps = true;
    protected $fillable = [
        "tournament_id",
        "category_id",
//        "confirmed",
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($categoryTournament) {
            foreach ($categoryTournament->ctus as $ctus) {
                $ctus->delete();
            }
//            foreach ($categoryTournament->settings as $setting) {
//                $setting->delete();
//            }

        });
        static::restoring(function ($categoryTournament) {
//            $categoryTournament->settings()->withTrashed()->restore();

//            foreach ($tournament->categoryTournaments()->withTrashed()->get() as $ct) {
//                $ct->restore();
//            }
            $categoryTournament->ctus()->withTrashed()->restore();
//            foreach ($categoryTournament->ctus()->withTrashed()->get() as $ctu) {
//
//                $ctu->restore();
//            }
        });
    }

    public function ctus()
    {
        return $this->hasMany('App\CategoryTournamentUser', 'category_tournament_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function tournament()
    {
        return $this->belongsTo('App\Tournament');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'category_tournament_user', 'category_tournament_id')
            ->withPivot('confirmed')
            ->withTimestamps();
    }

    public function settings()
    {
        return $this->hasOne(CategorySettings::class);
    }


    public function categoryTournaments()
    {
        return $this->belongsToMany(CategoryTournament::class, 'category_tournament_user');
    }

    public function setting()
    {
        return $this->belongsTo(CategorySettings::class);
    }


}
