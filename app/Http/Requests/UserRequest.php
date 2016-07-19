<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Contracts\Validation\UnauthorizedException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class UserRequest extends Request
{

    protected $method;

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
        $uniqueUser = '';
        $passwordRules = '';
        if ($this->method == 'POST') {
            $passwordRules = '|required|min:1';
            $uniqueUser = '|unique:users';
        }


        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255' . $uniqueUser,
            'password' => 'confirmed' . $passwordRules,
        ];
    }


    public function store(){

        $data = $this->except('_token');

        if ($this->is("users")) {
            $data['provider'] = "created";
        } else {
            $data['provider'] = "register";
        }

        $data['provider_id'] = $data['email'];
        $data['verified'] = 1;

        $user = new User;

        $user->fill($data);
        $user->password = bcrypt($this->password);

        if (Auth::user()->cannot('store', $user)) {
            throw new UnauthorizedException();
        }
        return $user->save();
    }

    public function update(User $user){

        if (Auth::user()->cannot('update', $user)) {
            throw new UnauthorizedException();
        }
        $except = [];
        if (trim($this->role_id) == '') {
            array_push($except, 'role_id');
        }

        if (trim($this->password) == '' && trim($this->password_confirmation) == '') {
            array_push($except, 'password');
        }
        array_push($except, '_token');

        $req = $this->except($except);

        $user->fill($req);
        if (!in_array('password', $except)) {
            $user->password = bcrypt($this->password);
        }
        return $user->save();
    }


}
