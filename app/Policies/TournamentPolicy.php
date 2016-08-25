<?php

namespace App\Policies;

//use Illuminate\Auth\Access\HandlesAuthorization;

use App\Tournament;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TournamentPolicy
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

        return true;
    }


    // You can store a user if you are not a simple user
    public function store(User $user, Tournament $tournament)
    {
        return true;
    }


    public function edit(User $user, Tournament $tournament)
    {
        return ($tournament->user_id == $user->id || $user->isSuperAdmin());

    }

    public function update(User $user, Tournament $tournament)
    {
        return ($tournament->user_id == $user->id || $user->isSuperAdmin());
    }

    public function destroy(User $user, Tournament $tournament)
    {
        return ($tournament->user_id == $user->id || $user->isSuperAdmin());
    }


}
