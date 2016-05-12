<?php

namespace App\Http;

use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        CheckForMaintenanceMode::class,
        Middleware\EncryptCookies::class,
        AddQueuedCookiesToResponse::class,
        StartSession::class,
        ShareErrorsFromSession::class,
//        Middleware\VerifyCsrfToken::class,
        Middleware\OwnTournament::class,
        Middleware\LocaleMiddleware::class,
//        Middleware\FederationMiddleware::class,
//        'throttle:60,1',
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => Middleware\Authenticate::class,
//        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => Middleware\RedirectIfAuthenticated::class,
        'roles' => Middleware\CheckRole::class,
        'ownTournament' => Middleware\OwnTournament::class,
        'ownUser' => Middleware\OwnUser::class,
        'federation' => Middleware\FederationMiddleware::class,
        'association' => Middleware\AssociationMiddleware::class,
//        'root' => Middleware\SuperAdmin::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
//        'localize' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
//        'localizationRedirect' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
//        'localeSessionRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class
//        'simpleauth' => Middleware\SimpleAuthMiddleware::class,
//        'jwt.auth' => \Tymon\JWTAuth\Middleware\GetUserFromToken::class,
//        'jwt.refresh' => \Tymon\JWTAuth\Middleware\RefreshToken::class
    ];
}
