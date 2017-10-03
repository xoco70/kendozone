<?php

namespace App\Repositories\Eloquent;

use App\Invite;

class InviteRepository extends BaseRepository
{


    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Invite::class;
    }

}