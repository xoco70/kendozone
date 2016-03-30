<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                dd('pas glop');
                return response(trans('msg.access_denied'), 401);
            } else {
                return redirect()->guest('auth/login');
            }
        } else {
            // If the user is not active any more, immidiately log out.
            if (Auth::check() && !Auth::user()->verified) {
                Auth::logout();
//                Session::flash('success', 'La cuenta no esta activa');
                flash()->error(Lang::get('auth.account_not_activated'));

                return redirect()->guest('auth/login');
            }
        }

        return $next($request);
    }
}
