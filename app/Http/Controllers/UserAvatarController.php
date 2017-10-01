<?php

namespace App\Http\Controllers;


class UserAvatarController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     */
    public function store()
    {
        $file = basename(
            request()
                ->file('file')
                ->store(config('constants.RELATIVE_AVATAR_PATH'), 'public')
        );

        auth()->user()->update(['avatar' => $file]);
        return response([], 204);
    }
}
