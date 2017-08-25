<?php

namespace App\Policies;

use App\Tournament;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
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
    public function create(User $user, Tournament $tournament)
    {
        return $user->isOwner($tournament);
    }


    public function edit(User $user, Tournament $tournament)
    {
        return $user->isOwner($tournament);
    }


    // You can store a user if you are not a simple user
    public function store(User $user, Tournament $tournament)
    {
        return $user->isOwner($tournament);
    }

    public function update(User $user, Tournament $tournament)
    {
        return $user->isOwner($tournament);
    }

    public function delete(User $user, \Xoco70\LaravelTournaments\Models\Tournament $tournament)
    {
        return $user->isOwner($tournament);
    }

}
