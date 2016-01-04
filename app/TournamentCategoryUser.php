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


    public function categoryTournament($ctId)
    {
        $tcu = TournamentCategoryUser::where('category_tournament_id', $ctId)->first();
        $tournamentCategoryId = $tcu->category_tournament_id;
        $tc = TournamentCategory::find($tournamentCategoryId);

        return $tc;
    }
    public function category($ctuId)
    {
        $tc = $this->categoryTournament($ctuId);
        $categoryId = $tc->category_id;
        $cat = Category::find($categoryId);
        return $cat;
    }

    public function tournament($ctuId){
        $tc = $this->categoryTournament($ctuId);
        $tourmanentId = $tc->tournament_id;
        $tour = Tournament::findOrNew($tourmanentId);
        return $tour;
    }

}
