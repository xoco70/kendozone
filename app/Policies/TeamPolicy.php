<?php

namespace App\Policies;

//use Illuminate\Auth\Access\HandlesAuthorization;

use App\Tournament;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     * @param User $user
     * @param Tournament $tournament
     * @param $ability
     * @return bool
     */
    public function before(User $user, Tournament $tournament, $ability)
    {
        if ($user->isSuperAdmin() || $tournament->user_id == $user->id) {
            return true;
        }
        return null;
    }

    // You can create a user if you are not a simple user
    public function create(User $user, Tournament $tournament)
    {
        // Quien puede crear un torneo:
        // Si es un torneo International, el presidente de fed
        // Si es un torneo National, el presidente de fed + el presidente de asso
        // Si es un torneo Regional, el presidente de fed + el presidente de asso
        // Si es un torneo Estatal, el presidente de fed + el presidente de asso + Club
        // Si es un torneo Municipal, el presidente de fed + el presidente de asso + Club
        // Si es un torneo Distrital, el presidente de fed + el presidente de asso + Club


        return $this->authorize($user, $tournament);
    }

    // You can store a user if you are not a simple user
    public function store(User $user, Tournament $tournament)
    {
        return $this->authorize($user, $tournament);
    }


    public function edit(User $user, Tournament $tournament)
    {
        return $this->authorize($user, $tournament);

    }

    public function update(User $user, Tournament $tournament)
    {
        return $this->authorize($user, $tournament);
    }

    public function destroy(User $user, Tournament $tournament)
    {
        return $this->authorize($user, $tournament);
    }


    private function authorize(User $user, Tournament $tournament)
    {
        $internationUser = [config('constants.ROLE_FEDERATION_PRESIDENT')];
        $nationalUser = [config('constants.ROLE_FEDERATION_PRESIDENT'), config('constants.ROLE_ASSOCIATION_PRESIDENT')];
        $regionalUser = [config('constants.ROLE_FEDERATION_PRESIDENT'), config('constants.ROLE_ASSOCIATION_PRESIDENT')];
        $stateUser = [config('constants.ROLE_FEDERATION_PRESIDENT'), config('constants.ROLE_ASSOCIATION_PRESIDENT'), config('constants.ROLE_CLUB_PRESIDENT')];
        $municipalUser = [config('constants.ROLE_FEDERATION_PRESIDENT'), config('constants.ROLE_ASSOCIATION_PRESIDENT'), config('constants.ROLE_CLUB_PRESIDENT')];
        $districtalUser = [config('constants.ROLE_FEDERATION_PRESIDENT'), config('constants.ROLE_ASSOCIATION_PRESIDENT'), config('constants.ROLE_CLUB_PRESIDENT')];
        $localUser = [config('constants.ROLE_FEDERATION_PRESIDENT'), config('constants.ROLE_ASSOCIATION_PRESIDENT'), config('constants.ROLE_CLUB_PRESIDENT')];
        $noLevelUser = [config('constants.ROLE_FEDERATION_PRESIDENT'), config('constants.ROLE_ASSOCIATION_PRESIDENT'), config('constants.ROLE_CLUB_PRESIDENT')];

// Como puedo saber si esta federacion participa???
        switch (true) {
            case $tournament->isInternational():
                if (!in_array($user->role_id, $internationUser)) return false;
                break;
            case $tournament->isNational():
                if (!in_array($user->role_id, $nationalUser)) return false;
                break;
            case $tournament->isRegional():
                if (!in_array($user->role_id, $regionalUser)) return false;
                break;
            case $tournament->isEstate():
                if (!in_array($user->role_id, $stateUser)) return false;
                break;
            case $tournament->isMunicipal():
                if (!in_array($user->role_id, $municipalUser)) return false;
                break;
            case $tournament->isDistrictal():
                if (!in_array($user->role_id, $districtalUser)) return false;
                break;
            case $tournament->isLocal():
                if (!in_array($user->role_id, $localUser)) return false;
                break;
            case $tournament->hasNoLevel():
                if (!$tournament->competitors->contains($user)) return false;
                break;
            default:
                return false;

        }
        return true;
    }

}
