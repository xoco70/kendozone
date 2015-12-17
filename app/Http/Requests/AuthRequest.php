<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Invite;
use GeoIP;
use Illuminate\Support\Facades\Config;
use Webpatser\Countries\Countries;

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

// TODO RElation with countryId

        $location = GeoIP::getLocation(Config::get('constants.CLIENT_IP')); // Simulating IP in Mexico DF
        if (!is_null($location)){
            $country = Countries::where("name", $location['country'])->first();
            if (is_null($country)){
                $country_id = Config::get('constants.COUNTRY_ID_DEFAULT');
            }else{
                $country_id = $country->id;
            }
            $request->request->add(['country_id' => $country_id ]);
            $request->request->add(['city' => $location['city'] ]);
            $request->request->add(['latitude' => $location['lat'] ]);
            $request->request->add(['longitude' => $location['lon'] ]);
        }else{
            $request->request->add(['country_id' => Config::get('constants.COUNTRY_ID_DEFAULT') ]);
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
