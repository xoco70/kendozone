<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Federation extends Model {

	protected $table = 'Federation';
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