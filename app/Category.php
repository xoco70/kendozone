<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;
use OwenIt\Auditing\AuditingTrait;

class Category extends Model
{
    use AuditingTrait;
    protected $table = 'category';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
        'gender',
        'isTeam',
        'ageCategory',
        'ageMin',
        'ageMax',
        'gradeCategory',
        'gradeMin',
        'gradeMax',
    ];

    public function getNameAttribute($name)
    {
        return Lang::get($name);
    }

    public function getGradeAttribute($grade)
    {
        return Lang::get($grade);
    }

    public function getAgeCategoryAttribute($ageCategory)
    {
        return Lang::get($ageCategory);
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
        return $this->team;
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

    public function buildName()
    {
//        dd($this);
        $ageCategories = [
            0 => trans('core.no_age'),
            1 => trans('core.children'),
            2 => trans('core.students'),
            3 => trans('core.adults'),
            4 => trans('core.masters'),
            5 => trans('core.custom')
        ];

        $genders = [
            'M' => trans('core.male'),
            'F' => trans('core.female'),
            'X' => trans('core.mixt')
        ];

        $grades = Grade::lists('name','id');
        $teamText = $this->isTeam == 1 ? trans('core.isTeam') : trans('core.single');

        $ageCategoryText = '';
        $gradeText = '';
//
        if ($this->ageCategory != 0) {
            if ($this->ageCategory == 5) {
                $ageCategoryText = ' - ' . trans('core.age') . ' : ';
                if ($this->ageMin != 0 && $this->ageMax != 0) {
                    $ageCategoryText .= $this->ageMin . ' - ' . $this->ageMax . ' ' . trans('core.years');
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
//        echo ($this->gradeCategory) ;

        if ($this->gradeCategory == 1) {
            $gradeText = trans('core.first_force');
        } else if ($this->gradeCategory == 2) {
            $gradeText = trans('core.second_force');
        } else if ($this->gradeCategory == 3) {

            $gradeText = ' - ' . trans('core.grade') . ' : ';
//            dd($grades);
            if ($this->gradeMin != 0 && $this->gradeMax != 0) {
                $gradeText .= $grades[$this->gradeMin] . ' - ' . $grades[$this->gradeMax];
            } else if ($this->gradeMin == 0 && $this->gradeMax != 0) {
                $gradeText .= ' < ' . $grades[$this->gradeMax];
            } else if ($this->gradeMin != 0 && $this->gradeMax == 0) {
                $gradeText .= ' > ' . $grades[$this->gradeMin];
            } else {
                $gradeText = '';
            }
        }
//        dd($teamText . ' ' . $genders[$this->gender] . ' ' . $ageCategoryText . ' ' . $gradeText);
        return $teamText . ' ' . $genders[$this->gender] . ' ' . $ageCategoryText . ' ' . $gradeText;

    }

//    public function shinpans()
//    {
//        return $this->hasMany('App\Shinpan');
//    }

//    public function competitors()
//    {
//        return $this->hasMany('App\Competitor');
//    }

//    public function teams()
//    {
//        return $this->hasMany('App\Team');
//    }

}
