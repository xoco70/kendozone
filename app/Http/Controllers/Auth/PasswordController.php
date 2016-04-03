<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $redirectPath = "auth/login";
    protected $subject = "Your Password Reset Link for Kendozone.com";

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEmail()
    {
        return view('password.email');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postEmail(Request $request)
    {

        $this->validate($request, ['email' => 'required|email']);

        $response = Password::sendResetLink($request->only('email'), function (Message $message) {

            $message->subject($this->getEmailSubject());
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                flash()->success(trans($response));
                return redirect()->back();

            case Password::INVALID_USER:
                flash()->error(trans($response));
                return redirect()->back();
        }
    }


    /**
     * Display the password reset view for the given token.
     *
     * @param  string $token
     * @return \Illuminate\Http\Response
     */
    public function getReset($token = null)
    {
        if (is_null($token)) {
            throw new NotFoundHttpException;
        }

        $reset = DB::table('password_resets')->where('token', $token)
            ->orderBy('created_at', 'desc')
            ->first();

        if (is_null($reset))
            throw new NotFoundHttpException;

        $email = $reset->email;
        return view('auth.reset',compact('token', 'email'));

    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postReset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                flash()->success(trans('auth.password_reset_successfull'));
                return redirect($this->redirectPath());

            default:
                flash()->error(trans($response));
                return redirect()->back()
                    ->withInput($request->only('email'));
        }
    }
//
//    /**
//     * Reset the given user's password.
//     *
//     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
//     * @param  string  $password
//     * @return void
//     */
//    protected function resetPassword($user, $password)
//    {
//        //$user->password = bcrypt($password);
//        // Sentry hashes password for us
//        $user->password = $password;
//
//        $user->save();
//
//        //Auth::login($user);
//    }


}
