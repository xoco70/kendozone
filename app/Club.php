<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model {

	protected $table = 'club';
	public $timestamps = true;

	protected $fillable = [
		'name',
		'asocId',

	];

	public function Association()
	{
		return $this->belongsTo('Association');
	}

}