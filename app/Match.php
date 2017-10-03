<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    const WAITING = 0;
    const RUNNING = 1;
    const PAUSED = 2;
    const FINISHED = 3;
    const NEED_DECISION = 4;
    const INVALID = 5;
    const EMPTY_PLACE = -1;

    public function fight()
    {
        return $this->belongsTo(Fight::class);
    }

    public function winner()
    {
        return $this->belongsTo(Competitor::class, 'winner_id');
    }

    public function assignReferees($referees)
    {
        $this->referees()->detach();
        foreach ($referees as $position => $referee) {
            $this->referees()->attach($referee, [
                'position' => $position
            ]);

        }
    }

    public function referees()
    {
        return $this->hasMany(Referee::class);
    }
}
