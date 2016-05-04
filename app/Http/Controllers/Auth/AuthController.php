<?php

namespace App\Http\Controllers\Auth;

use App;
use App\AuthenticateUser;
use App\Grade;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Invite;
use App\Mailers\AppMailer;
use App\Role;
use App\Tournament;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Laravel\Socialite\Facades\Socialite;
use URL;
use Validator;
use Webpatser\Countries\Countries;

class AuthController extends Controller
{
    private $redirectTo = '/';
    private $redirectAfterLogout = '/auth/login';

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    /**
     * Create a new authentication controller instance.
     *
     * @param Socialite $socialite
     */



    public function __construct(Socialite $socialite)
    {
        $this->socialite = $socialite;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6'
        ]);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);
//        $token = JWTAuth::attempt($credentials);
        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles && ! $lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

//    /**
//     * Create a new user instance after a valid registration.
//     *
//     * @param  array $data
//     * @return User
//     */
//    protected function create(AuthRequest $request)
//    {
//        $location = GeoIP::getLocation(Config::get('constants.CLIENT_IP')); // Simulating IP in Mexico DF
//        $country = $location['country'];
//        // Get id from country
//        $country = Countries::where('name', '=', $country)->first();
//
//        dd($request->name);
//        return User::create([
//            'name' => $request->name,
//            'email' => $data['email'],
//            'password' => bcrypt($data['password']),
//            'country_id' => $country->id,
//            'role_id' => $data['role_id'],
//            'city' => $location['city'],
//            'latitude' => $location['lat'],
//            'longitude' => $location['lon'],
//            'provider' => 'manual',
//            'provider_id' => $data['email']
//
//        ]);
//    }


    public function getRegister()
    {
        $role = Role::where('name', '=', "Admin")->firstOrFail();
        $role_id = $role->id;
//        dd($roleObj);
        $countries = Countries::lists('name', 'id');
        $grades = Grade::orderBy('order')->lists('name', 'id');
        return view('auth.register', compact('countries', 'grades', 'role_id'));
    }

    /**
     * Perform the registration.
     *
     * @param  Request $request
     * @param  AppMailer $mailer
     * @return \Redirect
     */
    public function postRegister(AuthRequest $request, AppMailer $mailer)
    {


        $user = User::create([  'name' => $request->name,
                                'email' => $request->email,
                                'password' => bcrypt($request->password),
                                'country_id' => $request->country_id,
                                'city' => $request->city,
                                'latitude' => $request->latitude,
                                'longitude' => $request->longitude,
                                'role_id' => Config::get('constants.ROLE_USER'),
                                'verified' => 0,

        ]);
        $mailer->sendEmailConfirmationTo($user);
        flash()->success(trans('msg.user_create_successful'));
//        else flash('error', 'operation_failed!');
//        return redirect("tournaments/$tournament->slug/edit")
        flash()->success(Lang::get('auth.check_your_email'));
        return redirect (URL::action('Auth\AuthController@getLogin'));
    }

    public function getInvite()
    {
        return view('auth.invite');
    }


    public function postInvite(AuthRequest $request)
    {
        $request->request->add(['role_id' => Config::get('constants.ROLE_USER')]);
        //Check token
        $user = null;
        $token = $request->get("token");
        $invite = Invite::getActiveInvite($token);
        if (!is_null($invite)) {
            $user = User::create($request->all());
            if (!is_null($user)) {
                Auth::loginUsingId($user->id);
            }
            $tournament = Tournament::find($invite->tournament_id);
            $userId = $user->id;
//            $invite->consume();

            flash()->success(Lang::get('auth.registration_completed'));
            return view("categories.register", compact('userId', 'tournament', 'invite'));

        } else {
            flash()->error(Lang::get('auth.no_invite'));
            return redirect(URL::action('Auth\AuthController@postLogin'))->with('status', 'error');
        }
    }


    /**
     * Confirm a user's email address.
     *
     * @param  string $token
     * @return mixed
     */
    public function confirmEmail($token)
    {
        User::whereToken($token)->firstOrFail()->confirmEmail();
        flash()->success(Lang::get('auth.tx_for_confirm'));
        return redirect(URL::action('Auth\AuthController@getLogin'));
    }

    /**
     * Attempt to sign in the user.
     *
     * @param  Request $request
     * @return boolean
     */
    protected function signIn(Request $request)
    {
        dd('signin');
        return Auth::attempt($this->getCredentials($request), $request->has('remember'));
    }
////
//    public function login()
//    {
//
//    }


    public function getSocialAuth(AuthenticateUser $authenticateUser, Request $request, $provider = null)
    {

        return $authenticateUser->execute($request->all(), $this, $provider);
    }

    public function userHasLoggedIn($user)
    {
//        flash('Welcome, ' . $user->name);
        return redirect(URL::action('DashboardController@index'));

    }

    /**
     * Get the login credentials and requirements.
     *
     * @param  Request $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
//            'verified' => true
        ];
    }

}
