<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Grade extends Model
{

    protected $table = 'grade';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
        'order'
    ];

    public function getNameAttribute($name)
    {

        return trans($name);
    }

    public static function getAll()
    {
        return Cache::remember('grades', config('constants.GRADE_MINUTES'), function () {
            return static::all();
        });
    }

    public static function getAllPlucked()
    {
        return Cache::remember('grades_pluck', config('constants.GRADE_MINUTES'), function () {
            return static::pluck('name', 'id');
        });
    }

}