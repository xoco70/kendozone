<?php
namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use GeoIP;
use Webpatser\Countries\Countries;

class UserRepository
{
    public function findByUserNameOrCreate($userData, $provider)
    {

        $user = User::where('provider_id', '=', $userData->id)->first();
        if (!$user) {
            // Check if there is no other user with same email
            $user = User::where('email', '=', $userData->email)->first();
            if (!$user){

                // get Large avatar
                $avatar = str_replace('sz=50', 'sz=120 ', $userData->avatar);
//                $avatar = str_replace('type=normal', 'type=large ', $avatar);
//dd (str_slug($userData->email));
                $user = User::create([
                    'provider' => $provider,
                    'provider_id' => $userData->id,
                    'name' => $userData->name,
                    'firstname' => $userData->name,
                    'username' => $userData->nickname,
                    'slug' => str_slug($userData->email),
                    'email' => $userData->email,
                    'avatar' => $avatar,
                    'role_id' => Config::get('constants.ROLE_USER'),
                    'verified' => 1,
                ]);
            }

            else{
                return null;
            }
        }

        $this->checkIfUserNeedsUpdating($userData, $user);
        return $user;
    }

    public function checkIfUserNeedsUpdating($userData, $user)
    {

        $socialData = [
            'avatar' => $userData->avatar,
            'email' => $userData->email,
            'firstname' => $userData->name,
            'name' => $userData->nickname,
        ];
        $dbData = [
            'avatar' => $user->avatar,
            'email' => $user->email,
            'firstname' => $user->name,
            'name' => $user->username,
        ];

        if (!empty(array_diff($socialData, $dbData))) {

            $avatar = str_replace('sz=50', 'sz=120', $userData->avatar);
//            $avatar = str_replace('type=normal', 'type=medium', $avatar);

            $user->avatar = $avatar;
            $user->slug = str_slug($userData->email);
            $user->email = $userData->email;
            $user->firstname = $userData->name;
            if (strlen($userData->nickname) != 0)
                $user->name = $userData->nickname;
            else
                $user->name = $userData->email;

//            dd($user);
            $user->save();
        }
    }
}