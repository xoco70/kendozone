<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Federation extends Model {

	protected $table = 'federation';
	public $timestamps = true;

	protected $fillable = [
		'name',
		'countryId',

	];

	public function association()
	{
		return $this->hasMany('Association');
	}

}