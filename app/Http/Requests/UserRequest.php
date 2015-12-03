<?php

namespace App\Http\Requests;

use GeoIP;

class UserRequest  extends Request
{

    protected $method;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @param \Illuminate\Http\Request $request
     */

    public function __construct(\Illuminate\Http\Request $request)
    {
//        dd($request);
        $method= $request->method;
//        dd($request->method);
        $location = GeoIP::getLocation("189.209.75.100"); // Simulating IP in Mexico DF

        $request->request->add(['country' => $location['country'] ]);
        $request->request->add(['countryCode' => $location['isoCode'] ]);
        $request->request->add(['city' => $location['city'] ]);
        $request->request->add(['latitude' => $location['lat'] ]);
        $request->request->add(['longitude' => $location['lon'] ]);

    }

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
        if ($this->method == 'POST'){
            $passwordRules = '|required|min:1';
            $uniqueUser = '|unique:users';
        }



        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255'.$uniqueUser,
//            'avatar' => 'mimes:png,jpg, jpeg, gif',
            'password' => 'confirmed'.$passwordRules,
        ];
    }


}
