<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class CategoryTournament extends Model
{
    protected $table = 'category_tournament';
    public $timestamps = true;
    protected $fillable = [
        "tournament_id",
        "category_id",
//        "confirmed",
    ];


//    public function ctu(){
//        return $this->hasMany('App\CategoryTournamentUser', 'category_tournament_id','id');
//    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function tournament(){
        return $this->belongsTo('App\Tournament');
    }

    public function users(){
        return $this->belongsToMany('App\User','category_tournament_user','category_tournament_id');
    }

    public function categoryTournaments()
    {
        return $this->belongsToMany(CategoryTournament::class, 'category_tournament_user');
    }


}
