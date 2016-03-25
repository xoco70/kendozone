<?php

namespace App\Http\Requests;

use App\Invite;
use App\User;
use Illuminate\Support\Facades\Config;

class AuthRequest extends Request
{

    public function __construct(\Illuminate\Http\Request $request)
    {
        // add roleId

        $request->request->add(['role_id' => Config::get('constants.ROLE_USER')]);

        $token = $request->get("token");
        if (!isNullOrEmptyString($token)) {
            $invite = Invite::getActiveInvite($token);
            if (!$request->has('email')) {
                $request->request->add(['email' => $invite->email]);
                $request->request->add(['verified' => 1]);
            }
        }

//        User::insertCoordsInRequest($request);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'avatar' => 'mimes:png,jpg, jpeg, gif',
            'password' => 'required|confirmed|min:6'
        ];
    }


}
