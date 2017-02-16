<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Country extends Model {

	protected $table = 'countries';
	public $timestamps = true;


    public static function getAll()
    {
        return Cache::remember('countries', config('constants.GRADE_MINUTES'), function () {
            return static::all();
        });
    }

    public static function getAllPlucked()
    {
        return Cache::remember('countries_pluck', config('constants.GRADE_MINUTES'), function () {
            return static::pluck('name', 'id');
        });
    }

}