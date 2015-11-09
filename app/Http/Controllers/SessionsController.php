<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginFormRequest;
use Sentinel;

class SessionsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(LoginFormRequest $request)
    {
        $input = $request->only('email', 'password');

        try {

            if (Sentinel::authenticate($input, $request->has('remember'))) {
                $this->redirectWhenLoggedIn();
            }

            return redirect()->back()->withInput()->withErrorMessage('Invalid credentials provided');

        } catch (\Cartalyst\Sentinel\Checkpoints\NotActivatedException $e) {
            return redirect()->back()->withInput()->withErrorMessage('User Not Activated.');
        } catch (\Cartalyst\Sentinel\Checkpoints\ThrottlingException $e) {
            return redirect()->back()->withInput()->withErrorMessage($e->getMessage());
        }

    }

    protected function redirectWhenLoggedIn()
    {
        // Logged in successfully - redirect based on type of user
        $user = Sentinel::getUser();
        $admin = Sentinel::findRoleByName('Admins');
        $users = Sentinel::findRoleByName('Users');

        if ($user->inRole($admin)) {
            return redirect()->intended('admin');
        } elseif ($user->inRole($users)) {
            return redirect()->intended('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id=null)
    {
        Sentinel::logout();

        return redirect()->route('home');
    }
}
