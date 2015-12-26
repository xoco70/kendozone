<?php

namespace App\Exceptions;

use Exception;
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
        HttpException::class,
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
                    'message' => 'Server Error',
                    'quote' => 'I will search for you through 1000 worlds and 10000 lifetimes!',
                    'author' => 'Kai',
                    'source' => '47 Ronin',
                ]
            );
        }else if ($e instanceof HttpException){
            return response()->view('errors.general',
                ['code' => '500',
                    'message' => 'Server Error',
                    'quote' => 'Failure is the key to success; each mistake teaches us something',
                    'author' => 'Morihei Ueshiba',
                    'source' => '',
                ]
            );
        }





//        .
//




        return parent::render($request, $e);
    }
}
