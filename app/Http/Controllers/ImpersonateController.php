<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function create()
    {
        return view('impersonate.create');
    }


    public function store(Request $request)
    {
        $id = $request->id;
        $email = $request->email;
        if ($id != null) {
            $user = User::findOrFail($id);
        } else {
            $user = User::where('email', $email)->firstOrFail();
        }


        Auth::user()->impersonate($user);
        return redirect("/");
    }
}
