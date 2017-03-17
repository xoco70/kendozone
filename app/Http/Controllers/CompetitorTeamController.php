<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Support\Facades\Response;

class CompetitorTeamController extends Controller
{
    public function store(Team $team, $competitorId) // add competitor to team
    {
        $team->competitors()->attach($competitorId)->withTimestamps();
    }

    public function update($team1Id, $team2Id, $competitorId) // move competitor to team
    {
        $team1 = Team::find($team1Id);
        $team2 = Team::find($team2Id);

        $team1->competitors()->detach($competitorId);
        $team2->competitors()->attach($competitorId)->withTimestamps();
    }

    public function destroy(Team $team, $competitorId) // remove competitor to team
    {
        if ($team->competitors()->detach($competitorId)) {
            return Response::json(['status' => 'success']);
        }
        return Response::json(['status' => 'error']);
    }


}
