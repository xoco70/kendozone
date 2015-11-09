<?php

namespace App\Repositories;

interface UserRepositoryInterface {
	public function getAll();
	public function find($id);
	public function updateRole($user_id, $role_id);
	public function create($fields);
}