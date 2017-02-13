<?php

namespace App\Policies;

use App\Association;
use App\User;

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
    public function create(User $user)
    {
        if ($user->isFederationPresident()) {
            return true;
        }
        return false;
    }

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
        return $association->belongsToFederationPresident($user);
    }

    /**
     *
     * @param User $user
     * @param Association $association
     * @return bool
     */
    public function edit(User $user, Association $association)
    {

        if ($user->isFederationPresident()) {
            return $association->belongsToFederationPresident($user);
        }

        if ($user->isAssociationPresident()) {
            return $association->belongsToAssociationPresident($user);

        }
        return false;
    }

    public function update(User $user, Association $association)
    {
        if ($user->isFederationPresident()) {
            return $association->belongsToFederationPresident($user);
        }

        if ($user->isAssociationPresident()) {
            return $association->belongsToAssociationPresident($user);

        }
        return false;
    }


}
