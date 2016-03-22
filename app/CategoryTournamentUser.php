<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class CategoryTournamentUser extends Model
{
//    use SoftDeletes;
    protected $dates = ['created_at', 'updated_at']; // ,'deleted_at'

    protected $table = 'category_tournament_user';
    public $timestamps = true;
    protected $fillable = [
        "tournament_category_id",
        "user_id",
        "confirmed",
    ];


    public function categoryTournament($ctId)
    {
        $tcu = CategoryTournamentUser::where('category_tournament_id', $ctId)->first();
        $CategoryTournamentId = $tcu->category_tournament_id;
        $tc = CategoryTournament::find($CategoryTournamentId);

        return $tc;
    }
    public function category($ctuId)
    {
        $tc = $this->categoryTournament($ctuId);
        $categoryId = $tc->category_id;
        $cat = Category::find($categoryId);
        return $cat;
    }


    public function categoryTournament2(){
        return $this->hasOne('App\CategoryTournament');


    }
    public function tournament($ctuId){
        $tc = $this->categoryTournament($ctuId);
        $tourmanentId = $tc->tournament_id;
        $tour = Tournament::findOrNew($tourmanentId);
        return $tour;
    }

}
