<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model {

	protected $table = 'team';
	public $timestamps = true;


	/**
	 * Get all Invitations that belongs to a team
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function invites()
	{
		return $this->morphMany(Invite::class, 'object');


	}

	/**
	 * Get all Invitations that belongs to a team
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function requests()
	{
		return $this->morphMany(Request::class, 'object');


	}

}