<?php

namespace App\Http\Controllers\StandardUser;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StandardUserController extends Controller
{
    public function getHome()
    {
        return view('protected.standardUser.user_dashboard');
    }

    public function getUserProtected()
    {
        return view('protected.standardUser.userPage');
    }
}
