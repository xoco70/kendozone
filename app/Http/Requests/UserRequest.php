<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
        if (Route::getCurrentRoute()->getName() == 'users.create') {

            $passwordRules = '|required|min:6';
            $uniqueUser = '|unique:users';
        }
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255' . $uniqueUser,
            'password' => 'confirmed' . $passwordRules,
        ];
        return $rules;
    }


    public function store()
    {

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
            throw new AuthorizationException();
        }
        return $user->save();
    }

    public function update(User $user)
    {
//        $this->authorize('update', [$user, Auth::user()]);

        if (Auth::user()->cannot('update', $user)) {
            throw new AuthorizationException();
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
        if ($this->avatar == "") {
            $req['avatar'] = null;
        }

        $user->fill($req);

        if (!in_array('password', $except)) {
            $user->password = bcrypt($this->password);
        }
        return $user->save();
    }


}
