<?php

namespace App\Http\Controllers\Api;

use App\Association;
use App\Club;
use App\Federation;
use App\Http\Requests;


class AdministrativeStructureController extends ApiController
{

    public static function getFederations()
    {
        return Federation::all(['id as value', 'name as text'])->toArray();
    }


    public function getAssociations($federationId)
    {
        return Association::where('federation_id', $federationId)->get(['id as value', 'name as text'])->toArray();

    }

    public function getClubs($federationId, $associationId)
    {
        return Club::where('association_id', $associationId)
            ->get(['id as value', 'name as text'])->toArray();
    }

}
