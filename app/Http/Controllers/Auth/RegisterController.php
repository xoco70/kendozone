<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Invite;
use App\Notifications\AccountCreated;
use App\Tournament;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;
use Validator;

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

    /**
     * Called when
     * @param AuthRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function registerFromInvite(AuthRequest $request)
    {

        $request->request->add(['role_id' => config('constants.ROLE_USER')]);
        //Check token
        $user = null;
        $token = $request->get("token");
        $invite = Invite::getActiveTournamentInvite($token);

        if (!is_null($invite)) {
//            dump($request->all());
//            $user = User::create($request->all());
            $user = User::create(['name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => config('constants.ROLE_USER'),
                'verified' => 1,

            ]);
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
            return redirect(URL::action('Auth\LoginController@login'))->with('status', 'error');
        }
    }

    /**
     * Handle a registration request for the application.
     *
     * @param AuthRequest $request
     * @return bool
     */
    public function register(AuthRequest $request)
    {
        try {
            $user = User::create(['name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'country_id' => $request->country_id,
                'city' => $request->city,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'role_id' => config('constants.ROLE_USER'),
                'verified' => 0,

            ]);

        } catch (QueryException $e) {
            flash()->error(trans('msg.user_create_error'));
            return redirect()->back();
        }

        $user->notify(new AccountCreated($user));
        flash()->success(trans('auth.check_your_email'));
        return redirect(URL::action('Auth\LoginController@login'));

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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
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


    /**
     * Confirm a user's email address.
     *
     * @param  string $token
     * @return mixed
     */
    public function confirmEmail($token)
    {
        $user = User::where('token', $token)->firstOrFail();
        $user->confirmEmail();

        Auth::loginUsingId($user->id);
        flash()->success(Lang::get('auth.tx_for_confirm'));
        return redirect(route('dashboard'));
    }

}
