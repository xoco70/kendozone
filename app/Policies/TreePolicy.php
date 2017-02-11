<?php

namespace App\Policies;

use App\Tournament;
use App\Tree;
use App\User;

class TreePolicy
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


    public function destroy(User $user, Tree $tree)
    {
        $tournament = $tree->championship->tournament;
        dd($tournament);
        return ($tournament->user_id == $user->id);

    }


}
