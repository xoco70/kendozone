<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\AuditingTrait;

class CategorySettings extends Model
{
    use SoftDeletes;
    use AuditingTrait;
    protected $dates = ['created_at', 'updated_at','deleted_at'];

    protected $table = 'category_settings';
    public $timestamps = true;
    protected $guarded = ['id'];

    public function championship(){
        return $this->belongsTo(Championship::class);
    }

    /**
     * @param $options
     * @param $ctId
     */
    public function createCategorySettingFromOptions($options, Championship $championship)
    {
        $cs = static::firstOrNew(['championship_id' => $championship->id]);
        $rules = $options[$championship->category->id];
//        $this->id = $ctId;
        $cs->championship_id = $championship->id;
        foreach ($rules as $key => $value) {
            $cs->$key = $value;
        }
        $cs->save();
    }


    //option to seed competitors

//    public static function getDefaultSettings()
//    {
//        if (Auth::check()) {
//            $user = Auth::user();
//            $categorySetting = $user->settings;
//
//            if ($categorySetting == null) {
//                $categorySetting = new CategorySettings();
//                $categorySetting->fightDuration = config('constants.CAT_FIGHT_DURATION');
//                $categorySetting->isTeam = config('constants.CAT_ISTEAM');
//                $categorySetting->teamSize = config('constants.CAT_TEAMSIZE');
//                $categorySetting->hasRoundRobin = config('constants.CAT_HASROUNDROBIN');
//                $categorySetting->roundRobinWinner = config('constants.CAT_ROUNDROBINWINNER');
//                $categorySetting->hasEncho = config('constants.CAT_HASENCHO');
//                $categorySetting->enchoQty = config('constants.CAT_enchoQty');
//                $categorySetting->enchoDuration = config('constants.CAT_ENCHO_DURATION');
//                $categorySetting->hasHantei = config('constants.CAT_HASHANTEI');
//                $categorySetting->cost = config('constants.CAT_COST');
//
//
//            } else {
//                if ($categorySetting->fightDuration == 0)
//                    $categorySetting->fightDuration = config('CAT_FIGHT_DURATION');
//
//                if ($categorySetting->hasRoundRobin && $categorySetting->roundRobinWinner == 0)
//                    $categorySetting->roundRobinWinner = config('CAT_ROUNDROBINWINNER');
//
//                if ($categorySetting->hasEncho && $categorySetting->enchoQty == 0)
//                    $categorySetting->enchoQty = config('CAT_enchoQty');
//
//                if ($categorySetting->hasEncho && $categorySetting->enchoDuration == 0)
//                    $categorySetting->enchoDuration = config('CAT_ENCHO_DURATION');
//
//            }
//            return $categorySetting;
//        }
//    }

}
