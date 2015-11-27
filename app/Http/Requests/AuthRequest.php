<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AuthRequest  extends Request
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
            'name' => 'required|max:255',
            'email' => 'required|confirmed|email|max:255|unique:users',
            'avatar' => 'mimes:png,jpg, jpeg, gif',
            'password' => 'required|confirmed|min:6'
        ];
    }
}
