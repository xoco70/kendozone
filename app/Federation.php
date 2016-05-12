<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Federation extends Model
{

    protected $table = 'federation';


    public function associations()
    {
        return $this->hasMany('Association');
    }

    public function country()
    {
        return $this->belongsTo('Webpatser\Countries\Countries');
    }

}