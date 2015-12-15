<?php

namespace App\Http\Controllers\Auth;

use App\AuthenticateUser;
use App\Grade;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\UserRequest;
use App\Invite;
use App\Mailers\AppMailer;
use App\Role;
use App\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

use GeoIP;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Webpatser\Countries\Countries;

class AuthController extends Controller
{
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
     * @return void
     */
    private $redirectTo = '/admin';
    private $redirectAfterLogout = '/auth/login';


    public function __construct(Socialite $socialite)
    {

        $this->socialite = $socialite;
        $this->middleware('guest', ['except' => 'getLogout']);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
//    public function postLogin(Request $request)
//    {
//        $this->validate($request, [
//            $this->loginUsername() => 'required', 'password' => 'required',
//        ]);
//
//
//        // If the class is using the ThrottlesLogins trait, we can automatically throttle
//        // the login attempts for this application. We'll key this by the username and
//        // the IP address of the client making these requests into this application.
//        $throttles = $this->isUsingThrottlesLoginsTrait();
//
//        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
//            return $this->sendLockoutResponse($request);
//        }
//
//        $credentials = $this->getCredentials($request);
////        dd($credentials);
////        dd(Auth::attempt($credentials, $request->has('remember')));
//
//        if (Auth::attempt($credentials)) {
//            return $this->handleUserWasAuthenticated($request, $throttles);
//        }
//
//        // If the login attempt was unsuccessful we will increment the number of attempts
//        // to login and redirect the user back to the login form. Of course, when this
//        // user surpasses their maximum number of attempts they will get locked out.
//        if ($throttles) {
//            $this->incrementLoginAttempts($request);
//        }
//
//        return redirect($this->loginPath())
//            ->withInput($request->only($this->loginUsername(), 'remember'))
//            ->withErrors([
//                $this->loginUsername() => $this->getFailedLoginMessage(),
//            ]);
//    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        $location = GeoIP::getLocation("189.209.75.100"); // Simulating IP in Mexico DF
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => $data['role_id'],
            'country' => $location['country'],
            'isoCode' => $location['isoCode'],
            'city' => $location['city'],
            'latitude' => $location['lat'],
            'longitude' => $location['lon'],
            'provider' => 'manual',
            'provider_id' => $data['email']

        ]);
    }


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


        $user = User::create($request->all());
        $mailer->sendEmailConfirmationTo($user);
        flash('success', Lang::get('auth.check_your_email'));
        return redirect()->back();
    }

    public function getInvite(Request $request)
    {
        return view('auth.invite');
    }

    /**
     * Perform the registration.
     *
     * @param  Request $request
     * @param  AppMailer $mailer
     * @return \Redirect
     */
    public function postInvite(AuthRequest $request)
    {

        //Check token
        $user = null;
        $token = $request->get("token");
        $invite = Invite::getActiveInvite($token);
        if (!is_null($invite)) {

            $user = User::create($request->all());
            $invite->consume();
            flash('success', Lang::get('auth.registration_completed'));

        } else {
            dd("yes is null");
            flash('error', Lang::get('auth.no_invite'));
        }

        if (!is_null($user)) {
            Auth::loginUsingId($user->id);
        }
        return redirect("/")->with('status', 'success');
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
        flash('success', Lang::get('auth.tx_for_confirm'));
        return redirect('auth/login');
    }

    /**
     * Attempt to sign in the user.
     *
     * @param  Request $request
     * @return boolean
     */
//    protected function signIn(Request $request)
//    {
//        return Auth::attempt($this->getCredentials($request), $request->has('remember'));
//    }
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
        flash('info', 'Welcome, ' . $user->username);
        return redirect('/admin');
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
