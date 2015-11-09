<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model {

	protected $table = 'Grade';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
        'order'
    ];

}