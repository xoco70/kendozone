<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TournamentRequest extends Request
{

    public function __construct(\Illuminate\Http\Request $request)
    {
        $request->request->add(['sport' => 1]);

        if (!$request->has("mustPay")) $request->request->add(['mustPay' => 0]);
        if (!$request->has("type"))    $request->request->add(['type' => 0]);

    }
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
            'date' => 'required|date',
//            'limitRegistrationDate' => 'date',
//            'venue' => 'required',
            'category' => 'required', // Disabled for Phpunit

        ];
    }
}
