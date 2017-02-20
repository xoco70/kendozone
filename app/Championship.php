<?php

namespace App;

class Championship extends \Xoco70\KendoTournaments\Models\Championship
{
    /**
     * A championship belongs to a Category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(\App\Category::class);
    }

    public function buildName()
    {


        if ($this->settings != null && $this->settings->alias != null && $this->settings->alias != '') return $this->settings->alias;

        $genders = [
            'M' => trans('categories.male'),
            'F' => trans('categories.female'),
            'X' => trans('categories.mixt')
        ];


        $teamText = $this->category->isTeam == 1 ? trans_choice('core.team',1) : trans('categories.single');
        $ageCategoryText = $this->category->getAgeString();
        $gradeText = $this->category->getGradeString();

        return $teamText . ' ' . $genders[$this->category->gender] . ' ' . $ageCategoryText . ' ' . $gradeText;
    }

}
