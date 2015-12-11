<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InviteRequest extends Request
{

    public function __construct(\Illuminate\Http\Request $request)
    {
//        dd($request);
        if (!$request->has('sport')){
            $request->request->add(['sport' => 1]);
        }
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
            'recipients' => 'required',

        ];
    }
}
