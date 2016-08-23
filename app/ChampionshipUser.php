<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\AuditingTrait;

class ChampionshipUser extends Model
{
    use SoftDeletes;
    use AuditingTrait;
    protected $DATES = ['created_at', 'updated_at','deleted_at'];


    protected $table = 'championship_user';
    public $timestamps = true;
    protected $fillable = [
        "tournament_category_id",
        "user_id",
        "confirmed",
    ];


    public function championship($ctId)
    {
        $tcu = ChampionshipUser::where('championship_id', $ctId)->first();
        $championshipId = $tcu->championship_id;
        $championship = Championship::find($championshipId);

        return $championship;
    }
    public function category($ctuId)
    {
        $championship = $this->championship($ctuId);
        $categoryId = $championship->category_id;
        $cat = Category::find($categoryId);
        return $cat;
    }


    public function championship2(){
        return $this->hasOne('App\Championship');


    }
    public function tournament($ctuId){
        $tc = $this->championship($ctuId);
        $tourmanentId = $tc->tournament_id;
        $tour = Tournament::findOrNew($tourmanentId);
        return $tour;
    }

    public function user(){
        return self::find($this->user_id);
    }
    

}
