<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        if ($e instanceof NotFoundHttpException) {
            return response()->view('errors.general',
                ['code' => '404',
                    'message' => 'Not Found',
                    'quote' => 'I will search for you through 1000 worlds and 10000 lifetimes!',
                    'author' => 'Kai',
                    'source' => '47 Ronin',
                ]
            );
        }
//        else if ($e instanceof HttpException){
//            return response()->view('errors   .general',
//                ['code' => '500',
//                    'message' => 'Server Error',
//                    'quote' => 'Failure is the key to success; each mistake teaches us something',
//                    'author' => 'Morihei Ueshiba',
//                    'source' => '',
//                ]
//            );
//        }

        return parent::render($request, $e);
    }
}


//Life is growth. If we stop growing, technically and spiritually, we are as good as dead.
//Those who are possessed by nothing possess everything.
//Economy is the basis of society. When the economy is stable, society develops. The ideal economy combines the spiritual and the material, and the best commodities to trade in are sincerity and love.
//“There are 3 reasons for why you can't beat me. First, I'm better looking than you are. Second, your blows are too light. And third, there's nothing in the world I can't tear up.”