<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Country extends Model
{

    public $timestamps = true;
    protected $table = 'countries';

    public static function getAll()
    {
        return Cache::rememberForever('countries', function () {
            return static::all();
        });
    }

    public static function getAllPlucked()
    {
        return Cache::rememberForever('countries_pluck', function () {
            return static::pluck('name', 'id');
        });
    }

}