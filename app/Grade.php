<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model {

	protected $table = 'grade';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
        'order'
    ];

    public function getNameAttribute($name)
    {

        return trans($name);
    }

}