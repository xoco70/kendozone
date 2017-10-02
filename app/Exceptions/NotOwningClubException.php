<?php

namespace App\Exceptions;


class NotOwningClubException extends CustomException
{
    public function render($request)
    {
        return response()->view('errors.general',
            ['code' => 403,
                'message' => trans('core.forbidden'),
                'quote' => trans('msg.you_dont_own_club'),
                'author' => trans('msg.please_ask_associationPresident'),
                'source' => "",
                'sentryID' => $this->sentryID,]
        );
    }

}
