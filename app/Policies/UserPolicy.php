<?php

namespace App\Policies;

//use Illuminate\Auth\Access\HandlesAuthorization;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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

    // You can create a user if you are not a simple user
    public function create(User $user)
    {
        if (!$user->isUser()) {
            return true;
        }
        return false;
    }

    // You can store a user if you are not a simple user
    public function store(User $user)
    {
        if (!$user->isUser()) {
            return true;
        }
        return false;
    }


    public function delete(User $user, User $userModel)
    {
        if ($user->isFederationPresident()) {
            return $user->federationOwned->id == $userModel->federation_id;
        }

        if ($user->isAssociationPresident()) {
            return $user->associationOwned->id == $userModel->association_id;
        }
        if ($user->isClubPresident()) {
            return $user->clubOwned->id == $userModel->club_id;
        }

    }

    public function edit(User $user, User $userModel)
    {
        if ($user->isFederationPresident() && $user->federationOwned != null) {
            return $user->federationOwned->id == $userModel->federation_id;
        }

        if ($user->isAssociationPresident() && $user->associationOwned != null) {
            return $user->associationOwned->id == $userModel->association_id;
        }

        if ($user->isClubPresident() && $user->clubOwned != null) {
            return $user->clubOwned->id == $userModel->club_id;
        }
        if ($user->isUser()) {
            return $user->id == $userModel->id;
        }
    }

    public function update(User $user, User $userModel)
    {
        if ($user->isFederationPresident()) {
            return $user->federationOwned->id == $userModel->federation_id;
        }

        if ($user->isAssociationPresident()) {
            return $user->associationOwned->id == $userModel->association_id;
        }
        if ($user->isUser()) {
            return $user->id == $userModel->id;
        }
    }


}
