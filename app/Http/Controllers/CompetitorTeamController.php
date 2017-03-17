<?php

namespace App\Http\Controllers;

use App\Team;

class CompetitorTeamController extends Controller
{
    public function store(Team $team, $competitorId)
    {
        $team->competitors()->attach($competitorId);

    }

    public function update(Team $team, $fighters)
    {

    }

    public function destroy(Team $team, $competitorId)
    {
        $team->competitors()->detach($competitorId);
    }


}
