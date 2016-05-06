<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Association extends Model
{

    protected $table = 'association';
    public $timestamps = true;

    protected $guarded = ['id'];



    public function president()
    {
        return $this->hasOne(User::class,'id','president_id');
    }

//    public function vicepresident()
//    {
//        return $this->hasOne(User::class,'id','vicepresident_id');
//    }
//
//    public function secretary()
//    {
//        return $this->hasOne(User::class,'id','secretary_id');
//    }
//
//    public function treasurer()
//    {
//        return $this->hasOne(User::class,'id','treasurer_id');
//    }

//    public function admin()
//    {
//        return $this->hasOne(User::class,'id','admin_id');
//    }


    public function clubs()
    {
        return $this->hasMany('Club');
    }

    public function federation()
    {
        return $this->belongsTo(Federation::class);
    }

}