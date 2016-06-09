<?php

namespace App\Policies;

use App\Association;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssociationPolicy
{
    /**
     * @param User $user
     * @param $ability
     * @return bool|null
     */
    public function before(User $user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
        return null;
    }

    // Only SuperAdmin And FederationPresident should be able to create Associations
    /**
     * @param User $user
     * @return bool
     */
//    public function create(User $user)
//    {
//        if ($user->isFederationPresident()) {
//            return true;
//        }
//        return false;
//    }

    // Only SuperAdmin And FederationPresident should be able to create Associations
    /**
     * @param User $user
     * @param Association $association
     * @return bool
     */
    public function store(User $user, Association $association)
    {
        if ($user->isFederationPresident()) {
            return true;
        }
        return false;
    }

    // Only SuperAdmin And FederationPresident should be able to delete Associations
    /**
     * @param User $user
     * @param Association $association
     * @return bool
     */
    public function delete(User $user, Association $association)
    {
        if ($user->isFederationPresident() &&
            $user->federationOwned!= null &&
            $association->federation->id == $user->federationOwned->id) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Association $association
     * @return bool
     */
    public function edit(User $user, Association $association)
    {

        if ($user->isAssociationPresident() &&
            $user->associationOwned!= null &&
            $association->id == $user->associationOwned->id) {
            return true;
        }
        return false;
    }

    public function update(User $user, Association $association)
    {
        if ($user->isAssociationPresident() &&
            $user->associationOwned!= null &&
            $association->id == $user->associationOwned->id) {
            return true;
        }
        return false;
    }


}
