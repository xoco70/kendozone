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

//    protected $fillable = [
//        'category',
//        'tournamentId',
//
//    ];

//
    public function tournaments()
    {
        return $this->belongsToMany('App\Tournament');
    }


    public function shinpans()
    {
        return $this->hasMany('App\Shinpan');
    }

    public function competitors()
    {
        return $this->hasMany('App\Competitor');
    }

    public function teams()
    {
        return $this->hasMany('App\Team');
    }

}
