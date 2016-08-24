<?php

namespace App\Policies;

use App\Club;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClubPolicy
{
    use HandlesAuthorization;


    public function before(User $user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
        return null;
    }

    public function create(User $user)
    {
        if ($user->isFederationPresident() || $user->isAssociationPresident()) {
            return true;
        }
        return false;
    }

    public function edit(User $user, Club $club)
    {
        if ($user->isFederationPresident()) {
            return $club->belongsToFederationPresident($user);
        }
        if ($user->isAssociationPresident()) {
            return $club->belongsToAssociationPresident($user);
        }
        if ($user->isClubPresident()) {
            return $club->belongsToClubPresident($user);
        }
        return false;

    }

    public function update(User $user, Club $club)
    {
        if ($user->isFederationPresident()) {
            return $club->belongsToFederationPresident($user);
        }
        if ($user->isAssociationPresident()) {
            return $club->belongsToAssociationPresident($user);
        }
        if ($user->isClubPresident()) {
            return $club->belongsToClubPresident($user);
        }
        return false;
    }

    public function store(User $user, Club $club)
    {
        if ($user->isFederationPresident()) {
            return $club->belongsToFederationPresident($user);

        }
        if ($user->isAssociationPresident()) {
            return $club->belongsToAssociationPresident($user);
        }
        return false;
    }

    public function delete(User $user, Club $club)
    {
        if ($user->isFederationPresident()) {
            return $club->belongsToFederationPresident($user);

        }
        if ($user->isAssociationPresident()) {
            return $club->belongsToAssociationPresident($user);
        }
        return false;
    }


}
