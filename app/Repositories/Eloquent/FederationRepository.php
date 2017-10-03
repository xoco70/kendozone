<?php

namespace App\Repositories\Eloquent;

use App\Federation;

class FederationRepository extends BaseRepository
{


    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Federation::class;
    }

    public function getFederationWithPresidentAndCountry()
    {
        return Federation::with('president', 'country');
    }

}    
