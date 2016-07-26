<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\AuditingTrait;

/**
 * @property mixed team
 * @property mixed gender
 * @property mixed ageCategory
 * @property mixed ageMin
 * @property mixed ageMax
 * @property mixed gradeMin
 * @property mixed gradeMax
 * @property mixed isTeam
 */
class Category extends Model
{
    use AuditingTrait;
    protected $table = 'category';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
        'alias',
        'gender',
        'isTeam',
        'ageCategory',
        'ageMin',
        'ageMax',
        'gradeCategory',
        'gradeMin',
        'gradeMax',
    ];

    public function getCategorieslabelByRule($ruleId = null)
    {
        //TODO Refactor Redundancy

        $ikf_settings = null;
        $ekf_settings = null;
        $lakc_settings = null;

        if ($ruleId == null) {
            $ikf_settings = static::whereIn('id',array_keys(config('options.ikf_settings')))->select('name')->get();
            $ikf_settings = $multiplied = $ikf_settings->map(function ($item, $key) {
                return $item->name;
            })->toArray();

            $ekf_settings = static::whereIn('id',array_keys(config('options.ekf_settings')))->select('name')->get();
            $ekf_settings = $multiplied = $ekf_settings->map(function ($item, $key) {
                return $item->name;
            })->toArray();

            $lakc_settings = static::whereIn('id',array_keys(config('options.lakc_settings')))->select('name')->get();
            $lakc_settings = $multiplied = $lakc_settings->map(function ($item, $key) {
                return $item->name;
            })->toArray();
        } else {

        }
        $result = [$ikf_settings, $ekf_settings, $lakc_settings];
        return $result;
    }

    public function getAliasString(){
        return $this->alias;
    }

    public function getNameAttribute($name)
    {

        return trans($name);
    }

    public function getGradeAttribute($grade)
    {
        return trans($grade);
    }

    public function getAgeCategoryAttribute($ageCategory)
    {
        return trans($ageCategory);
    }

    public function tournaments()
    {
        return $this->belongsToMany('App\Tournament');
    }

    public function settings()
    {
        return $this->hasOne('App\CategorySettings');
    }

//    public function user(){
//        return $this->belongsToMany('App\User', 'category_tournament_user', 'category_tournament_id');
//    }

    public function categoryTournament()
    {
        return $this->hasMany(CategoryTournament::class);
    }

    public function isTeam()
    {
        return $this->isTeam;
    }

    public function isForMen()
    {
        return $this->gender == "M";
    }

    public function isForWomen()
    {
        return $this->gender == "F";
    }

    public function isMixt()
    {
        return $this->gender == "X";
    }

    public function getAgeString()
    {
        $ageCategoryText = '';
        $ageCategories = [
            0 => trans('core.no_age'),
            1 => trans('core.children'),
            2 => trans('core.students'),
            3 => trans('core.adults'),
            4 => trans('core.masters'),
            5 => trans('core.custom')
        ];

        if ($this->ageCategory != 0) {
            if ($this->ageCategory == 5) {
                $ageCategoryText = ' - ' . trans('core.age') . ' : ';
                if ($this->ageMin != 0 && $this->ageMax != 0) {
                    if ($this->ageMin == $this->ageMax) {
                        $ageCategoryText .= $this->ageMax . ' ' . trans('core.years');
                    } else {
                        $ageCategoryText .= $this->ageMin . ' - ' . $this->ageMax . ' ' . trans('core.years');
                    }

                } else if ($this->ageMin == 0 && $this->ageMax != 0) {
                    $ageCategoryText .= ' < ' . $this->ageMax . ' ' . trans('core.years');
                } else if ($this->ageMin != 0 && $this->ageMax == 0) {
                    $ageCategoryText .= ' > ' . $this->ageMin . ' ' . trans('core.years');
                } else {
                    $ageCategoryText = '';
                }
            } else {
                $ageCategoryText = $ageCategories[$this->ageCategory];
            }
        }
        return $ageCategoryText;
    }

    public function getGradeString($grades)
    {
        $gradeText = '';
        if ($this->gradeCategory == 1) {
            $gradeText = trans('core.first_force');
        } else if ($this->gradeCategory == 2) {
            $gradeText = trans('core.second_force');
        } else if ($this->gradeCategory == 3) {

            $gradeText = ' - ' . trans('categories.grade') . ' : ';
//            dd($grades);
            if ($this->gradeMin != 0 && $this->gradeMax != 0) {
                if ($this->gradeMin == $this->gradeMax) {
                    $gradeText .= $grades[$this->gradeMin];
                } else {
                    $gradeText .= $grades[$this->gradeMin] . ' - ' . $grades[$this->gradeMax];
                }
            } else if ($this->gradeMin == 0 && $this->gradeMax != 0) {
                $gradeText .= ' < ' . $grades[$this->gradeMax];
            } else if ($this->gradeMin != 0 && $this->gradeMax == 0) {
                $gradeText .= ' > ' . $grades[$this->gradeMin];
            } else {
                $gradeText = '';
            }
        }

        return $gradeText;
    }


    public function buildName($grades)
    {

        if ($this->alias != null && $this->alias != '') return $this->alias;

        $genders = [
            'M' => trans('categories.male'),
            'F' => trans('categories.female'),
            'X' => trans('categories.mixt')
        ];


        $teamText = $this->isTeam == 1 ? trans('categories.isTeam') : trans('categories.single');
        $ageCategoryText = $this->getAgeString();
        $gradeText = $this->getGradeString($grades);

        return $teamText . ' ' . $genders[$this->gender] . ' ' . $ageCategoryText . ' ' . $gradeText;
    }
}
