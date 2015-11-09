<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShiaiCategory extends Model {

	protected $table = 'shiaiCategory';
	public $timestamps = true;

	protected $fillable = [
			'category',
			'tournamentId',

	];

	public function Shinpan()
	{
		return $this->hasMany('Shinpan');
	}

	public function Competitor()
	{
		return $this->hasMany('Competitor');
	}

	public function Team()
	{
		return $this->hasMany('Team');
	}

}