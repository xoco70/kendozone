<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\AuthRequest;
use App\Invite;
use App\Mailers\AppMailer;
use App\Tournament;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function postInvite(AuthRequest $request)
    {
        $request->request->add(['role_id' => config('constants.ROLE_USER')]);
        //Check token
        $user = null;
        $token = $request->get("token");
        $invite = Invite::getActiveTournamentInvite($token);
        if (!is_null($invite)) {
            $user = User::create($request->all());
            if (!is_null($user)) {
                Auth::loginUsingId($user->id);
            }
            $tournament = Tournament::find($invite->object_id);
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
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @param AppMailer $mailer
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request, AppMailer $mailer)
    {
        $user = User::create([  'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'country_id' => $request->country_id,
            'city' => $request->city,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'role_id' => config('constants.ROLE_USER'),
            'verified' => 0,

        ]);

        $mailer->sendEmailConfirmationTo($user);
        flash()->success(trans('auth.check_your_email'));
        return redirect (URL::action('Auth\AuthController@getLogin'));
//        $this->validator($request->all())->validate();
//
//        $this->guard()->login($this->create($request->all()));

//        return redirect($this->redirectPath());
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
