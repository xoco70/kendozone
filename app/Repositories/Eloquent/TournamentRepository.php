<?php

namespace App\Repositories\Eloquent;

use App\Tournament;

class TournamentRepository extends BaseRepository
{


    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Tournament::class;
    }

}