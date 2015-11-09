<?php

namespace Fight;

use Illuminate\Database\Eloquent\Model;

class Fight extends Model {

	protected $table = 'fight';
	public $timestamps = true;

	public function shiaiCategory()
	{
		return $this->belongsTo('ShiaiCategory');
	}

}