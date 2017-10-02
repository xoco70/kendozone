<?php

namespace App\Exceptions;


class NotOwningFederationException extends CustomException
{
    public function render($request)
    {
        return response()->view('errors.general',
            ['code' => 403,
                'message' => trans('core.forbidden'),
                'quote' => trans('msg.you_dont_own_federation'),
                'author' => trans('msg.please_ask_superadmin'),
                'source' => "",
                'sentryID' => $this->sentryID,]
        );
    }

}