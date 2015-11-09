<?php

namespace App\Http\Controllers\StandardUser;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\UsersEditFormRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    /**
     * @var $user
     */
    protected $user;


    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;

        $this->middleware('notCurrentUser', ['only' => ['show', 'edit', 'update']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = $this->user->find($id);

        return view('protected.standardUser.show')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);

        return view('protected.standardUser.edit')->withUser($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, UsersEditFormRequest $request)
    {
        $user = $this->user->find($id);

        if (! $request->has("password")) {
            $input = $request->only('email', 'first_name', 'last_name');

            $user->fill($input)->save();

            return redirect()->route('profiles.edit', $user->id)
                             ->withFlashMessage('User has been updated successfully!');

        } else {
            $input = $request->only('email', 'first_name', 'last_name', 'password');

            $user->fill($input);
            $user->password = \Hash::make($request->input('password'));
            $user->save();

            return redirect()->route('profiles.edit', $user->id)
                             ->withFlashMessage('User (and password) has been updated successfully!');
        }
    }
}
