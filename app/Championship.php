<?php

namespace App;

class Championship extends \Xoco70\KendoTournaments\Models\Championship
{
    /**
     * A championship belongs to a Category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(\App\Category::class);
    }

    public function teams()
    {
        return $this->hasMany(\App\Team::class);
    }

    public function categoryTeams() {
        return $this->hasOne(Category::class)->isTeam();
    }
}
