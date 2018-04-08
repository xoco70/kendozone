<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Grade extends Model
{
    public $timestamps = true;
    protected $table = 'grade';
    protected $fillable = [
        'id',
        'name',
        'order'
    ];

    public static function getAll()
    {
        return Cache::remember('grades', config('constants.GRADE_MINUTES'), function () {
            return static::all();
        });
    }

    public static function getAllPlucked()
    {
        return Cache::rememberForever('grades_pluck', function () {
            return static::pluck('name', 'id');
        });

    }

    public function getNameAttribute($name)
    {
        return trans($name);
    }

}