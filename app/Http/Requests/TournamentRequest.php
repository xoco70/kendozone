<?php

namespace App\Http\Requests;

class TournamentRequest extends Request
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
            'name' => 'required|min:6',
            'dateIni' => 'required|date',
            'dateFin' => 'required|date',
            'category' => 'required', // Disabled for Phpunit

        ];
    }
}
