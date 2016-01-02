<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class TournamentCategoryUser extends Model
{
    protected $table = 'category_tournament_user';
    public $timestamps = true;
    protected $fillable = [
        "tournament_category_id",
        "user_id",
        "confirmed",
    ];


    public static function category($ctuId)
    {
        $tcu = TournamentCategoryUser::find($ctuId);
        $tournamentCategoryId = $tcu->category_tournament_id;
        $tc = TournamentCategory::find($tournamentCategoryId);
        $categoryId = $tc->category_id;
        $cat = Category::find($categoryId);
        return $cat;
    }

}
