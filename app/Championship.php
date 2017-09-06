<?php

namespace App;

class Championship extends \Xoco70\LaravelTournaments\Models\Championship
{
    /**
     * A championship belongs to a Category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(\App\Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teams()
    {
        return $this->hasMany(\App\Team::class);
    }

    /**
     * A championship belongs to a Tournament.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    /**
     * Generate Round Titles
     * @param $numFighters
     * @return array
     */
    public function getRoundTitle($numFighters): array
    {
        $roundTitles = [];
        if ($this->hasPreliminary()) {
            $roundTitles[] = 'Preliminary';
            $this->noTeams = $numFighters / $this->getSettings()->preliminaryGroupSize;
        } else if ($this->isSingleEliminationType()) {
            $this->noTeams = $numFighters;
        } else if ($this->isPlayOffType()) {
            $this->noTeams = $numFighters;
        }

        if ($this->noTeams == 2) {
            $roundTitles[] = 'Final';
        } elseif ($this->noTeams <= 4) {
            $roundTitles[] = 'Semi-Finals';
            $roundTitles[] = 'Final';
        } elseif ($this->noTeams <= 8) {
            $roundTitles[] = 'Quarter-Finals';
            $roundTitles[] = 'Semi-Finals';
            $roundTitles[] = 'Final';
        } else {
            $roundTitles[] = 'Quarter-Finals';
            $roundTitles[] = 'Semi-Finals';
            $roundTitles[] = 'Final';

            $noRounds = ceil(log($this->noTeams, 2));
            $noTeamsInFirstRound = pow(2, ceil(log($this->noTeams) / log(2)));
            $tempRounds = array();

            //The minus 3 is to ignore the final, semi final and quarter final rounds

            for ($i = 0; $i < $noRounds - 3; $i++) {
                $tempRounds[] = 'Last ' . $noTeamsInFirstRound;
                $noTeamsInFirstRound /= 2;
            }

            $roundTitles = array_merge($tempRounds, $roundTitles);

        }
        return $roundTitles;
    }
}
