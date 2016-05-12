<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Validation\UnauthorizedException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Foundation\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        $code = "";
        $message = "";
        $quote = "";
        $author = "";
        $source = "";

        switch ($e) {
            case $e instanceof NotFoundHttpException:
                $code = "404";
                $message = "Not Found";
                $quote = "I will search for you through 1000 worlds and 10000 lifetimes!";
                $author = "Kai";
                $source = "47 Ronin";
                break;
            case $e instanceof HttpException:
                $code = "500";
                $message = "Server Error";
                $quote = "Failure is the key to success; each mistake teaches us something";
                $author = "Morihei Ueshiba";
                $source = "";
                break;
            case $e instanceof UnauthorizedException:
                $code = "403";
                $message = trans('core.forbidden');
                $quote = '“And this is something I must accept - even if, like acid on metal, it is slowly corroding me inside.”';
                $author = 'Tabitha Suzuma';
                $source = trans('core.forbidden');
                break;
            case $e instanceof InvitationNeededException:
                $code = "403";
                $message = trans('core.forbidden');
                $quote = trans('msg.invitation_needed');
                $author = "Admin";
                $source = "";
                break;
            default:
                return parent::render($request, $e);
        }
        return response()->view('errors.general',
            ['code' => $code,
                'message' => $message,
                'quote' => $quote,
                'author' => $author,
                'source' => $source,
            ]
        );

    }
}


//Life is growth. If we stop growing, technically and spiritually, we are as good as dead.
//Those who are possessed by nothing possess everything.
//Economy is the basis of society. When the economy is stable, society develops. The ideal economy combines the spiritual and the material, and the best commodities to trade in are sincerity and love.
//“There are 3 reasons for why you can't beat me. First, I'm better looking than you are. Second, your blows are too light. And third, there's nothing in the world I can't tear up.”