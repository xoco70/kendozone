<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class TournamentRequest extends Request
{

//    public function __construct(\Illuminate\Http\Request $request){
//        dd($request);
//    }
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
        // If the rules are defined, categories are no longer mandatory
        if ($this->rule_id == 0) {
            return [
                'name' => 'required|min:6',
                'dateIni' => 'required|date',
                'dateFin' => 'required|date',
                'category' => 'required',
            ];
        }

        return [
            'name' => 'required|min:6',
            'dateIni' => 'required|date',
            'dateFin' => 'required|date',
        ];

    }

    public function persist()
    {
        $tournament = Auth::user()->tournaments()->create($this->except('category','config'));
        if ($this->rule_id == 0) {
            $tournament->categories()->sync($this->input('category'));
        } else {
            $tournament->setAndConfigureCategories($this->rule_id);
        }
        return $tournament;
    }
}
