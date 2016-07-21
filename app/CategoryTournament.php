<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryTournament extends Model
{
    use SoftDeletes;
    protected $dates = ['created_at', 'updated_at','deleted_at'];
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
            $categoryTournament->ctus()->delete();
            $categoryTournament->settings()->delete();
        });
        static::restoring(function ($categoryTournament) {
            $categoryTournament->ctus()->restore();
            $categoryTournament->settings()->restore();

        });
    }

    public function ctus()
    {
        return $this->hasMany(CategoryTournamentUser::class, 'category_tournament_id', 'id');
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
        return $this->belongsToMany(User::class, 'category_tournament_user', 'category_tournament_id')
            ->withPivot('confirmed')
            ->withTimestamps();
    }

    public function settings()
    {
        return $this->hasOne(CategorySettings::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
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
