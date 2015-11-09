<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Association extends Model {

	protected $table = 'association';
	public $timestamps = true;

	protected $fillable = [
		'name',
	];

}