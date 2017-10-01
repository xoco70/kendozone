<?php

namespace App;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Category extends \Xoco70\LaravelTournaments\Models\Category
{
    const AGE_CUSTOM = 5;

    /**
     * Get All Presets for Categories
     * @param null $ruleId
     * @return array
     */
    public function getCategorieslabelByRule($ruleId = null)
    {
        $result = [];

        if ($ruleId == null) {
            $rules = ['ikf', 'ekf', 'lakc'];
            foreach ($rules as $rule) {
                $result[] = static::whereIn('id', array_keys(config('options.' . $rule . '_settings')))
                    ->select('name')->get()
                    ->map->name->toArray();
            }
        }
        return $result;
    }

    /**
     * Build Age String
     * @return string
     */
    public function getAgeString()
    {
        $ageCategories = [
            0 => trans('categories.no_age'),
            1 => trans('categories.children'),
            2 => trans('categories.students'),
            3 => trans('categories.adults'),
            4 => trans('categories.masters'),
            5 => trans('categories.custom')
        ];

        if ($this->ageCategory == self::AGE_CUSTOM) {
            $ageCategoryText = ' - ' . trans('categories.age') . ' : ';
            if ($this->ageMin != 0 && $this->ageMax != 0) {
                return $this->hasAgeMinAndMax($ageCategoryText);
            }
            if ($this->ageMin == 0 && $this->ageMax != 0) {
                return $ageCategoryText .= ' < ' . $this->ageMax . ' ' . trans('categories.years');
            }
            if ($this->ageMin != 0 && $this->ageMax == 0) {
                return $ageCategoryText .= ' > ' . $this->ageMin . ' ' . trans('categories.years');
            }
            return '';
        }
        return $ageCategories[$this->ageCategory];
    }

    /**
     * Build Grade String
     * @return string
     */
    public function getGradeString()
    {
        $grades = Grade::getAll();
        $gradeText = '';

        if ($this->gradeCategory == 1) {
            return trans('categories.first_force');
        }
        if ($this->gradeCategory == 2) {
            return trans('categories.second_force');
        }
        if ($this->gradeCategory == 3) {
            $gradeText = ' - ' . trans('core.grade') . ' : ';
            if ($this->gradeMin != 0 && $this->gradeMax != 0) {
                return $this->hasGradeMinAndMax($grades, $gradeText);
            }
            if ($this->gradeMin == 0 && $this->gradeMax != 0) {
                return $gradeText .= ' < ' . $grades[$this->gradeMax - 1]->name;
            }
            if ($this->gradeMin != 0 && $this->gradeMax == 0) {
                return $gradeText .= ' > ' . $grades[$this->gradeMin - 1]->name;
            }
        }
        return '';
    }

    public function scopeIsTeam($query)
    {
        return $query->where('isTeam', 1);
    }


    public function buildName()
    {

        if (Auth::check()) {
            App::setLocale(Auth::user()->locale);
        }
        $genders = [
            'M' => trans('categories.male'),
            'F' => trans('categories.female'),
            'X' => trans('categories.mixt')
        ];

        $teamText = $this->isTeam() ? trans_choice('core.team', 1) : trans('categories.single');
        $ageCategoryText = $this->getAgeString();
        $gradeText = $this->getGradeString();

        return $teamText . ' ' . $genders[$this->gender] . ' ' . $ageCategoryText . ' ' . $gradeText;
    }

    /**
     * @param $ageCategoryText
     * @return string
     */
    protected function hasAgeMinAndMax($ageCategoryText): string
    {
        if ($this->ageMin == $this->ageMax) {
            $ageCategoryText .= $this->ageMax . ' ' . trans('categories.years');
        } else {
            $ageCategoryText .= $this->ageMin . ' - ' . $this->ageMax . ' ' . trans('categories.years');
        }
        return $ageCategoryText;
    }

    /**
     * @param $grades
     * @param $gradeText
     * @return string
     */
    protected function hasGradeMinAndMax($grades, $gradeText): string
    {
        if ($this->gradeMin == $this->gradeMax) {
            $gradeText .= $grades[$this->gradeMin - 1]->name;
        } else {
            $gradeText .= $grades[$this->gradeMin - 1]->name . ' - ' . $grades[$this->gradeMax - 1]->name;
        }
        return $gradeText;
    }
}
