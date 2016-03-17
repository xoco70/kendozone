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
        'gender',
        'isTeam',
        'ageCategory',
        'grade'
    ];

    public function getNameAttribute($name)
    {
        return Lang::get($name);
    }

    public function getGradeAttribute($grade)
    {
        return Lang::get($grade);
    }

    public function getAgeCategoryAttribute($ageCategory)
    {
        return Lang::get($ageCategory);
    }

    public function tournaments()
    {
        return $this->belongsToMany('App\Tournament');
    }

    public function settings()
    {
        return $this->hasOne('App\CategorySettings');
    }

//    public function user(){
//        return $this->belongsToMany('App\User', 'category_tournament_user', 'category_tournament_id');
//    }

    public function categoryTournament()
    {
        return $this->hasMany(CategoryTournament::class);
    }

    public function isTeam()
    {
        return $this->team;
    }

    public function isForMen()
    {
        return $this->gender == "M";
    }

    public function isForWomen()
    {
        return $this->gender == "F";
    }

    public function isMixt()
    {
        return $this->gender == "X";
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
