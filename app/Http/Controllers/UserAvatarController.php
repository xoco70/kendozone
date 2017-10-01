<?php

namespace App\Http\Controllers;


use App\Avatar;
use Illuminate\Http\Request;

class UserAvatarController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data = Avatar::uploadPic($data);
        return $data;

    }
}
