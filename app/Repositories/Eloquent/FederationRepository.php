<?php
namespace App\Repositories\Eloquent;

use App\Federation;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\User;

class FederationRepository implements UserRepositoryInterface
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

}