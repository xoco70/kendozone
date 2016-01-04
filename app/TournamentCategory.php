<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class TournamentCategory extends Model
{
    protected $table = 'category_tournament';
    public $timestamps = true;
    protected $fillable = [
        "tournament_id",
        "category_id",
//        "confirmed",
    ];


    public function ctu(){
        return $this->hasMany('App\TournamentCategoryUser', 'category_tournament_id','id');
    }



}
