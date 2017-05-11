<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;

class TournamentLevel extends Model
{

    protected $table = 'tournamentLevel';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
    ];
    public function getNameAttribute($name)
    {
        return trans($name);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tournaments()
    {
        return $this->hasMany('App\Tournament', 'level_id', 'id');
    }

    public static function getAllPlucked()
    {
        return Cache::remember('level_pluck', config('constants.GRADE_MINUTES'), function () {
            return static::pluck('name', 'id');
        });
    }


}