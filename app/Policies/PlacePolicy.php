<?php

namespace App\Policies;

use App\Place;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlacePolicy
{
    use HandlesAuthorization;


    public function see(User $user, Place $place)
    {
        // places that are only in my country
        // return $place->isInCountry($user->countryId);

        // return true if user has see_places permission

    }
}
