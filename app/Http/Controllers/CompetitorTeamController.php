<?php

namespace App\Http\Controllers;

use App\Team;

class CompetitorTeamController extends Controller
{
    public function store(Team $team, $fighterId)
    {
        $team->competitors()->attach($fighterId);

    }

    public function update(Team $team, $fighters)
    {

    }

    public function destroy(Team $team, $fighter)
    {

    }


}
