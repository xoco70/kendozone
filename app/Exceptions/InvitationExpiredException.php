<?php

namespace App\Exceptions;

class InvitationExpiredException extends CustomException
{
    public function render($request)
    {
        return response()->view('errors.general',
            ['code' => 403,
                'message' => trans('core.forbidden'),
                'quote' => trans('msg.invitation_expired'),
                'author' => "Admin",
                'source' => "",
                'sentryID' => $this->sentryID,
            ]
        );
    }

}
