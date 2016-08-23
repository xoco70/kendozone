<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $table = 'venue';
    public $timestamps = true;
    protected $fillable = [
        'venue_name',
        'coords',
        'address',
        'details',
        'city',
        'CP',
        'state',
        'country_id',
        'latitude',
        'longitude',
    ];

    public function country(){
        return $this->hasOne(Country::class);
    }




}
