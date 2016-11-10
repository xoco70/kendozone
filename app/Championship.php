<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class Championship extends Model
{
    use SoftDeletes;
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
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
            $championship->competitors()->delete();
            $championship->settings()->delete();
        });
        static::restoring(function ($championship) {
            $championship->competitors()->restore();
            $championship->settings()->restore();

        });
    }

    public function competitors()
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

    public function hasPreliminary()
    {
        return ($this->settings == null || $this->settings->hasPreliminary);
    }

    public function isRoundRobinType()
    {
        return ($this->settings != null && $this->settings->treeType == Config::get('constants.ROUND_ROBIN'));
    }

    public function isDirectEliminationType()
    {
        return ($this->settings == null || $this->settings->treeType == Config::get('constants.DIRECT_ELIMINATION'));
    }

    public function tree()
    {
//        if ($this->hasPreliminary()){
            return $this->hasMany(PreliminaryTree::class,'championship_id');
//        }

//        if ($this->isRoundRobinType())
//            return $this->belongsToMany(PreliminaryTree::class);
//        if ($this->isDirectEliminationType())
//            return $this->belongsToMany(PreliminaryTree::class);
    }

}
