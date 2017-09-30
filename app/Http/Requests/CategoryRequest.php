<?php

namespace App\Http\Requests;

use App\Category;

class CategoryRequest extends Request
{


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name' => 'required|min:6'
        ];
    }

    /**
     * Build Query with Filters
     * @return Category
     */
    public function getCategoryByFilters()
    {
        $category = Category::where('isTeam', '=', $this->isTeam)
            ->where('gender', '=', $this->gender)
            ->where('gradeCategory', '=', $this->gradeCategory)
            ->where('ageCategory', '=', $this->ageCategory);

        if ($this->ageMin != null) $category = $category->where('ageMin', $this->ageMin);
        if ($this->ageMax != null) $category = $category->where('ageMax', $this->ageMax);
        if ($this->gradeMin != null) $category = $category->where('gradeMin', $this->gradeMin);
        if ($this->gradeMax != null) $category = $category->where('gradeMax', $this->gradeMax);

        return $category->select('name')->first() ?? new Category();
    }

}
