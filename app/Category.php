<?php

namespace App;

use OwenIt\Auditing\AuditingTrait;

class Category extends \Xoco70\KendoTournaments\Models\Category
{

    /**
     * Get All Presets for Categories
     * @param null $ruleId
     * @return array
     */
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


    /**
     * Build Age String
     * @return string
     */
    public function getAgeString()
    {
        $ageCategoryText = '';
        $ageCategories = [
            0 => trans('categories.no_age'),
            1 => trans('categories.children'),
            2 => trans('categories.students'),
            3 => trans('categories.adults'),
            4 => trans('categories.masters'),
            5 => trans('categories.custom')
        ];

        if ($this->ageCategory != 0) {
            if ($this->ageCategory == 5) {
                $ageCategoryText = ' - ' . trans('categories.age') . ' : ';
                if ($this->ageMin != 0 && $this->ageMax != 0) {
                    if ($this->ageMin == $this->ageMax) {
                        $ageCategoryText .= $this->ageMax . ' ' . trans('categories.years');
                    } else {
                        $ageCategoryText .= $this->ageMin . ' - ' . $this->ageMax . ' ' . trans('categories.years');
                    }

                } else if ($this->ageMin == 0 && $this->ageMax != 0) {
                    $ageCategoryText .= ' < ' . $this->ageMax . ' ' . trans('categories.years');
                } else if ($this->ageMin != 0 && $this->ageMax == 0) {
                    $ageCategoryText .= ' > ' . $this->ageMin . ' ' . trans('categories.years');
                } else {
                    $ageCategoryText = '';
                }
            } else {
                $ageCategoryText = $ageCategories[$this->ageCategory];
            }
        }
        return $ageCategoryText;
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
            $gradeText = trans('categories.first_force');
        } else if ($this->gradeCategory == 2) {
            $gradeText = trans('categories.second_force');
        } else if ($this->gradeCategory == 3) {

            $gradeText = ' - ' . trans('core.grade') . ' : ';
            if ($this->gradeMin != 0 && $this->gradeMax != 0) {
                if ($this->gradeMin == $this->gradeMax) {
                    $gradeText .= $grades[$this->gradeMin-1]->name;
                } else {
                    $gradeText .= $grades[$this->gradeMin-1]->name . ' - ' . $grades[$this->gradeMax-1]->name;
                }
            } else if ($this->gradeMin == 0 && $this->gradeMax != 0) {
                $gradeText .= ' < ' . $grades[$this->gradeMax-1]->name;
            } else if ($this->gradeMin != 0 && $this->gradeMax == 0) {
                $gradeText .= ' > ' . $grades[$this->gradeMin-1]->name;
            } else {
                $gradeText = '';
            }
        }

        return $gradeText;
    }


    public function buildName()
    {


        if ($this->alias != null && $this->alias != '') return $this->alias;

        $genders = [
            'M' => trans('categories.male'),
            'F' => trans('categories.female'),
            'X' => trans('categories.mixt')
        ];


        $teamText = $this->isTeam == 1 ? trans_choice('core.team',1) : trans('categories.single');
        $ageCategoryText = $this->getAgeString();
        $gradeText = $this->getGradeString();

        return $teamText . ' ' . $genders[$this->gender] . ' ' . $ageCategoryText . ' ' . $gradeText;
    }
}
