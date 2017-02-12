<?php

namespace App\Policies;

use App\Tournament;
use App\Round;
use App\User;

class RoundPolicy
{
//    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
        return null;
    }


    // You can store a user if you are not a simple user
    public function store(User $user, Tournament $tournament)
    {
        return ($tournament->user_id == $user->id);
    }


    public function destroy(User $user, Round $tree)
    {
        $tournament = $tree->championship->tournament;
        dd($tournament);
        return ($tournament->user_id == $user->id);

    }


}
