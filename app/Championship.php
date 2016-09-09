<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Championship extends Model
{
    use SoftDeletes;
    protected $dates = ['created_at', 'updated_at','deleted_at'];
    protected $table = 'championship';

    public $timestamps = true;
    protected $fillable = [
        "tournament_id",
        "category_id",
//        "confirmed",
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($championship) {
            $championship->ctus()->delete();
            $championship->settings()->delete();
        });
        static::restoring(function ($championship) {
            $championship->ctus()->restore();
            $championship->settings()->restore();

        });
    }

    public function ctus()
    {
        return $this->hasMany(Competitor::class, 'championship_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'competitor', 'championship_id')
            ->withPivot('confirmed')
            ->withTimestamps();
    }

    public function settings()
    {
        return $this->hasOne(ChampionshipSettings::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }



    public function championships()
    {
        return $this->belongsToMany(Championship::class, 'competitor');
    }

    public function setting()
    {
        return $this->belongsTo(ChampionshipSettings::class);
    }


}
