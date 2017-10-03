<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    public $timestamps = true;
    protected $table = 'venue';
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

    /**
     * A Venue Belongs to a Country
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }


    /**
     * Get the Current User location
     * @param $tournament
     * @param $latitude
     * @param $longitude
     * @return $this
     */
    public function setDefaultLocation($tournament, $latitude, $longitude)
    {
        $userLat = $tournament != null ? $tournament->owner->latitude : null;
        $userLng = $tournament != null ? $tournament->owner->longitude : null;

        if ($latitude != null && $longitude != null) {
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
