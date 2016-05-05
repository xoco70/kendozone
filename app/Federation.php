<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Federation extends Model
{

    protected $table = 'federation';
    public $timestamps = true;

    protected $guarded = ['id'];



    public function president()
    {
        return $this->hasOne(User::class,'id','president_id');
    }

    public function vicepresident()
    {
        return $this->hasOne(User::class,'id','vicepresident_id');
    }

    public function secretary()
    {
        return $this->hasOne(User::class,'id','secretary_id');
    }

    public function treasurer()
    {
        return $this->hasOne(User::class,'id','treasurer_id');
    }

    public function admin()
    {
        return $this->hasOne(User::class,'id','admin_id');
    }


    public function association()
    {
        return $this->hasMany('Association');
    }

    public function country()
    {
        return $this->belongsTo('Webpatser\Countries\Countries');
    }

}