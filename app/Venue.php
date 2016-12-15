<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Venue extends Model
{
    protected $table = 'venue';
    public $timestamps = true;
    protected $fillable = [
        'venue_name',
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
        return $this->belongsTo(Country::class);
    }


    public function setDefaultLocation($latitude, $longitude){
        $userLat = Auth::check() ? Auth::user()->latitude : "";
        $userLng = Auth::check() ? Auth::user()->longitude : "" ;


        if (!isNullOrEmptyString($longitude) && !isNullOrEmptyString($longitude)) {
            $this->latitude = $latitude;
            $this->longitude = $longitude;

        } else if (!isNullOrEmptyString($userLat) && !isNullOrEmptyString($userLng)) {
            $this->latitude = $userLat;
            $this->longitude = $userLng;
        } else {
            //TODO Should popup for user localization
            $this->latitude = 0;
            $this->longitude = 0;
        }
        return $this;

    }

}
