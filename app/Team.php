<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    protected $table = 'team';
    public $timestamps = true;
    protected $fillable = ['name', 'category_tournament_id'];


    public function category_tournament()
    {
        return $this->belongsTo(CategoryTournament::class);
    }

    public function category()
    {
        return $this->hasManyThrough(Category::class, CategoryTournament::class);
    }

    /**
     * Get all Invitations that belongs to a team
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invites()
    {
        return $this->morphMany(Invite::class, 'object');


    }

    /**
     * Get all Invitations that belongs to a team
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requests()
    {
        return $this->morphMany(Request::class, 'object');


    }

}