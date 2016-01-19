<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

class Category extends Model
{
    protected $table = 'category';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
    ];

    public function getNameAttribute($name)
    {
        return Lang::get($name);
    }

    public function tournaments()
    {
        return $this->belongsToMany('App\Tournament');
    }

    public function settings()
    {
        return $this->hasOne('App\CategorySettings');
    }

    public function user(){
        return $this->belongsToMany('App\User', 'category_tournament_user', 'category_tournament_id');
    }

    public function categoryTournament()
    {
        return $this->hasMany(CategoryTournament::class);
    }

//    public function shinpans()
//    {
//        return $this->hasMany('App\Shinpan');
//    }

//    public function competitors()
//    {
//        return $this->hasMany('App\Competitor');
//    }

//    public function teams()
//    {
//        return $this->hasMany('App\Team');
//    }

}
