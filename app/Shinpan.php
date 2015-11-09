<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shinpan extends Model {

	protected $table = 'Shinpan';
	public $timestamps = true;

	public function User()
	{
		return $this->hasOne('User');
	}

}