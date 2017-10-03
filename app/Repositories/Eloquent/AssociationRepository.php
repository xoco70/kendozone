<?php

namespace App\Repositories\Eloquent;

use App\Association;

class AssociationRepository extends BaseRepository
{


    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Association::class;
    }

    public function getAssociationWithPresidentAndCountry()
    {
        return Association::with('president', 'federation.country');
    }

    public function findByIdWithTrash($id)
    {
        return Association::withTrashed()->find($id);
    }

}