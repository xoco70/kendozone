<?php

namespace App\Exceptions;

use App\Http\Middleware\OwnTournament;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Swift_TransportException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    private $sentryID;

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthenticationException::class,
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        OwnTournament::class,
        AuthorizationException::class,
        MaintenanceModeException::class,
        InvitationNeededException::class,
        TokenMismatchException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if ($this->shouldReport($exception)) {
            $params = [];
            if (Auth::check()) {
                $params = [
                    'user' => [
                        'id' => Auth::user()->id,
                        'email' => Auth::user()->email
                    ],
//                    'extra' => ['foo' => 'bar'],
//                    'tags' => array('Francia' => 'Campeon!!!')
                ];
            }
            $this->sentryID = app('sentry')->captureException($exception, $params);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        if (App::environment('local')) {
            return parent::render($request, $exception);
        }

        switch ($exception) {

            case $exception instanceof NotFoundHttpException:
                $code = "404";
                $message = "Not Found";
                $quote = "I will search for you through 1000 worlds and 10000 lifetimes!";
                $author = "Kai";
                $source = "47 Ronin";
                break;

            case $exception instanceof ModelNotFoundException:
                $code = "500";
                $message = "Model Not Found";
                $quote = "To be stupid, selfish, and have good health are three requirements for happiness, though if stupidity is lacking, all is lost.";
                $author = "Gustave Flaubert";
                $source = "";
                break;
            case $exception instanceof AuthorizationException:
                $code = "403";
                $message = trans('core.forbidden');
                $quote = '“And this is something I must accept - even if, like acid on metal, it is slowly corroding me inside.”';
                $author = 'Tabitha Suzuma';
                $source = trans('core.forbidden');
                break;
            case $exception instanceof InvitationNeededException:
                $code = "403";
                $message = trans('core.forbidden');
                $quote = trans('msg.invitation_needed');
                $author = "Admin";
                $source = "";
                break;

            case $exception instanceof InvitationExpiredException:
                $code = "403";
                $message = trans('core.forbidden');
                $quote = trans('msg.invitation_expired');
                $author = "Admin";
                $source = "";
                break;


            case $exception instanceof NotOwningFederationException:
                $code = "403";
                $message = trans('core.forbidden');
                $quote = trans('msg.you_dont_own_federation');
                $author = trans('msg.please_ask_superadmin');
                $source = "";
                break;

            case $exception instanceof NotOwningAssociationException:
                $code = "403";
                $message = trans('core.forbidden');
                $quote = trans('msg.you_dont_own_association');
                $author = trans('msg.please_ask_federationPresident');
                $source = "";
                break;

            case $exception instanceof NotOwningClubException:
                $code = "403";
                $message = trans('core.forbidden');
                $quote = trans('msg.you_dont_own_club');
                $author = trans('msg.please_ask_associationPresident');
                $source = "";
                break;

            case $exception instanceof Swift_TransportException:
                $code = "500";
                $message = $exception->getMessage();
                $quote = "Email can't be sent. Try again after 1000 suburis.";
                $author = "";
                $source = "";
                break;
            default:
                return parent::render($request, $exception);
        }

        if ($exception instanceof MaintenanceModeException)
            return response()->view('errors.503');


        return response()->view('errors.general',
            ['code' => $code,
                'message' => $message,
                'quote' => $quote,
                'author' => $author,
                'source' => $source,
                'sentryID' => $this->sentryID,
            ]
        );
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Auth\AuthenticationException $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}
//Life is growth. If we stop growing, technically and spiritually, we are as good as dead.
//Those who are possessed by nothing possess everything.
//Economy is the basis of society. When the economy is stable, society develops. The ideal economy combines the spiritual and the material, and the best commodities to trade in are sincerity and love.
//“There are 3 reasons for why you can't beat me. First, I'm better looking than you are. Second, your blows are too light. And third, there's nothing in the world I can't tear up.”
//There is truth in vine.
// The only true langage in the world is a Men (Musset Adaptation)