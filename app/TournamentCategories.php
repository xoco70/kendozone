<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class TournamentCategories extends Model
{
    protected $table = 'category_tournament';
    public $timestamps = true;
    protected $fillable = [
        "tournament_id",
        "category_id",
        "confirmed",
    ];




}
