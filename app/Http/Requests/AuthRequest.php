<?php

namespace App\Http\Requests;

use App\Invite;

class AuthRequest extends Request
{

    public function __construct(\Illuminate\Http\Request $request)
    {
        // Insert needed fields in request if not present

        $request->request->add(['role_id' => config('constants.ROLE_USER')]);

        $token = $request->get("token");
        if (!isNullOrEmptyString($token)) {
            $invite = Invite::getInviteFromToken($token);
            if (!$request->has('email')) {
                $request->request->add(['email' => $invite->email]);
                $request->request->add(['verified' => 1]);
            }
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'avatar' => 'mimes:png,jpg, jpeg, gif',
            'password' => 'required|confirmed|min:6'
        ];
    }


}
