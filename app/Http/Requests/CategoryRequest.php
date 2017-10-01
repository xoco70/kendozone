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

        $this->has('ageMin') ? $category = $category->where('ageMin', $this->ageMin) : '';
        $this->has('ageMax') ? $category = $category->where('ageMax', $this->ageMax) : '';
        $this->has('gradeMin') ? $category = $category->where('gradeMin', $this->gradeMin) : '';
        $this->has('gradeMax') ? $category = $category->where('gradeMax', $this->gradeMax) : '';

        return $category->select('name')->first() ?? new Category();
    }

}
