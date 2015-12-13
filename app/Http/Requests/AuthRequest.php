<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use GeoIP;

class AuthRequest  extends Request
{

    public function __construct(\Illuminate\Http\Request $request)
    {
        $token = $request->get("token");
        if (!isNullOrEmptyString($token)){
            $invite = Invite::getActiveInvite($token);
            if (!$request->has('email')) {
                $request->request->add(['email' => $invite->email]);
                $request->request->add(['verified' => 1]);
            }
        }



        $location = GeoIP::getLocation("189.209.75.100"); // Simulating IP in Mexico DF
        if (!is_null($location)){
            $request->request->add(['country' => $location['country'] ]);
            $request->request->add(['countryCode' => $location['isoCode'] ]);
            $request->request->add(['city' => $location['city'] ]);
            $request->request->add(['latitude' => $location['lat'] ]);
            $request->request->add(['longitude' => $location['lon'] ]);
        }else{
            $request->request->add(['country' => "France" ]);
            $request->request->add(['countryCode' => "FR" ]);
            $request->request->add(['city' => "Paris" ]);
            $request->request->add(['latitude' => "48.858222" ]);
            $request->request->add(['longitude' => "2.2945" ]);
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
