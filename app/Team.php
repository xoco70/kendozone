<?php

namespace App;

class Team extends \Xoco70\LaravelTournaments\Models\Team
{
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($team) {
            $teams = Team::where('championship_id', $team->championship_id)
                ->where('id', '>', $team->id)->get();
            foreach ($teams as $team) {
                $team->short_id--;
                $team->save();
            }
        });
    }

    /**
     * Get all Invitations that belongs to a team
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function invites()
    {
        return $this->morphMany(Invite::class, 'object');
    }

    /**
     * Get all Invitations that belongs to a team
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function requests()
    {
        return $this->morphMany(Request::class, 'object');
    }
}