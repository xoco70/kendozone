<?php

namespace App\Policies;

//use Illuminate\Auth\Access\HandlesAuthorization;

use App\Federation;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FederationPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     * @param User $user
     * @param $ability
     * @return bool
     */
    public function before(User $user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
        return null;
    }

    // Only SuperAdmin should be able to create Federations
    public function create(User $user)
    {
        return false;
    }

    // Only SuperAdmin should be able to store Federations
    public function store(User $user, Federation $federation)
    {
        return false;
    }

    // Only SuperAdmin should be able to delete Federations
    public function delete(User $user, Federation $federation)
    {
        return false;
    }

    public function edit(User $user, Federation $federation)
    {
        if ($user->federationOwned == null)
            return false;

        return $user->federationOwned->id == $federation->id;
    }

    public function update(User $user, Federation $federation)
    {
        if ($user->federationOwned == null)
            return false;

        return $user->federationOwned->id == $federation->id;
    }


}
