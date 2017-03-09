<?php

namespace App\Policies;

use App\FightersGroup;
use App\Tournament;
use App\User;

class FightersGroupPolicy
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


    public function destroy(User $user, FightersGroup $tree)
    {
        $tournament = $tree->championship->tournament;
        dd($tournament);
        return ($tournament->user_id == $user->id);

    }


}
