<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competitor extends Model {

	protected $table = 'Competitor';
	public $timestamps = true;

	public function User()
	{
		return $this->hasOne('User');
	}
	protected $fillable = [
		'userId',
		'shiaiCategoryId',
        'clubId',


	];

}