<?php namespace App;
// AuthenticateUser.php
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Contracts\Factory as Socialite;
use URL;

class AuthenticateUser {

    private $socialite;
    private $auth;
    private $users;

    public function __construct(Socialite $socialite, Guard $auth, UserRepository $users) {
        $this->socialite = $socialite;
        $this->users = $users;
        $this->auth = $auth;
    }

    public function execute($request, $listener, $provider) {

        if (!$request) {

            return $this->getAuthorizationFirst($provider);
        }
//        dd("it passed");
        $user = $this->users->findByUserNameOrCreate($this->getSocialUser($provider), $provider);
        if (!is_null($user)){
            $this->auth->login($user, true);
        }else{
            Session::flash('error', Lang::get('auth.account_already_exists'));

            return redirect(URL::action('Auth\LoginController@login'))
                ->with('message', Lang::get('auth.account_already_exists'));
        }


        return redirect(route('dashboard'));
    }

    private function getAuthorizationFirst($provider) {
        return $this->socialite->driver($provider)->redirect();
    }

    private function getSocialUser($provider) {
        return $this->socialite->driver($provider)->user();
    }
}