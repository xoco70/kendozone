<?php

namespace App\Repositories;

// use Cartalyst\Sentinel\Users\EloquentUser as User;
use App\User;
use \DB;
use \Sentinel;

class DbUserRepository implements UserRepositoryInterface {

	public function getAll()
	{
		return User::all();
	}

	public function find($id)
	{
		return User::findOrFail($id);
	}

	public function updateRole($user_id, $role_id)
    {
    	DB::table('role_users')
            ->where('user_id', $user_id)
            ->update(['role_id' => $role_id]);
    }

    public function create($fields)
    {
    	return Sentinel::create($fields);
    }



}