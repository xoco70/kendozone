<?php

namespace App\Http\Controllers\Api;

use App\Association;
use App\Club;
use App\Federation;
use App\Http\Requests;


class AdministrativeStructureController extends ApiController
{

    public function getFederations()
    {
        return Federation::all();
    }

    public function getAssociations(Federation $federation)
    {
        return Association::where('federation_id', $federation->id);

    }

    public function getClubs(Association $association)
    {
        return Club::where('association_id', $association->id);
    }

}
