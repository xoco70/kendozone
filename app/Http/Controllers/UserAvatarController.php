<?php

namespace App\Http\Controllers;


use Intervention\Image\Facades\Image;

class UserAvatarController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     */
    public function store()
    {
        request()->validate([
            'file' => ['required', 'image']
        ]);
        $file = request()
            ->file('file')
            ->store(config('constants.RELATIVE_AVATAR_PATH'), 'public');

        Image::make(storage_path('app/public/' . $file))
            ->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->save();

        auth()->user()->update([
            'avatar' => basename($file)
        ]);
        return response([], 204);
    }
}
