<?php
namespace App\Repositories\Eloquent;

use App\Club;

class ClubRepository extends BaseRepository
{


    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Club::class;
    }

}