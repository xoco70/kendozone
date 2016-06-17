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

    public function create(User $user, Club $club)
    {
        if ($user->isFederationPresident() || $user->isAssociationPresident()) {
            return true;
        }
//        if ($user->isFederationPresident()) {
//            if ($user->federationOwned->id == $club->association->federation->id)
//                return true;
//
//        } else if ($user->isAssociationPresident()) {
//                if ($user->associationOwned->id == $club->association->id)
//                return true;
//        }
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

    public function destroy(User $user, Club $club)
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
