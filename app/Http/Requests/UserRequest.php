<?php

namespace App\Http\Requests;

class UserRequest extends Request
{

    protected $method;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @param \Illuminate\Http\Request $request
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
        $uniqueUser = '';
        $passwordRules = '';
        if ($this->method == 'POST') {
            $passwordRules = '|required|min:1';
            $uniqueUser = '|unique:users';
        }

    
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255' . $uniqueUser,
//            'avatar' => 'mimes:png,jpg, jpeg, gif',
            'password' => 'confirmed' . $passwordRules,
        ];
    }


}
