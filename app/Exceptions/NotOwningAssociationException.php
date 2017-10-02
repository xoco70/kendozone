<?php

namespace App\Exceptions;


class NotOwningAssociationException extends CustomException
{
    public function render($request)
    {
        return response()->view('errors.general',
            ['code' => 403,
                'message' => trans('core.forbidden'),
                'quote' => trans('msg.you_dont_own_association'),
                'author' => trans('msg.please_ask_federationPresident'),
                'source' => "",
                'sentryID' => $this->sentryID,]
        );
    }

}