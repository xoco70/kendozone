<?php namespace App;

use App\Repositories\Eloquent\UserRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Contracts\Factory as Socialite;
use PDOException;
use URL;

/**
 *  Class used by Socialite for Social Logging
 */
class AuthenticateUser
{

    private $socialite;
    private $auth;
    private $users;

    public function __construct(Socialite $socialite, Guard $auth, UserRepository $users)
    {
        $this->socialite = $socialite;
        $this->users = $users;
        $this->auth = $auth;
    }

    /**
     * @param $request
     * @param $listener
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function execute($request, $listener, $provider)
    {

        if (!$request) {
            return $this->getAuthorizationFirst($provider);
        }
        try {
            $user = $this->users->findByUserNameOrCreate($this->getSocialUser($provider), $provider);
        } catch (PDOException $e) {
            return redirect(URL::action('Auth\LoginController@login'))
                ->with('message', Lang::get('auth.fb_is_not_sharing_email'));
        }

        if (!is_null($user)) {
            $this->auth->login($user, true);
        } else {
            Session::flash('error', Lang::get('auth.account_already_exists'));

            return redirect(URL::action('Auth\LoginController@login'))
                ->with('message', Lang::get('auth.account_already_exists'));
        }
        return redirect(route('dashboard'));
    }

    /**
     * @param $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    private function getAuthorizationFirst($provider)
    {
        return $this->socialite->driver($provider)->redirect();
    }

    /**
     * @param $provider
     * @return \Laravel\Socialite\Contracts\User
     */
    private function getSocialUser($provider)
    {
        return $this->socialite->driver($provider)->user();
    }
}