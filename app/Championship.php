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
        return $this->belongsTo(Category::class);
    }
}
