<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
//        Middleware\VerifyCsrfToken::class,
        Middleware\Own::class,


//        'throttle:60,1',
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => Middleware\RedirectIfAuthenticated::class,
        'roles' => Middleware\CheckRole::class,
        'own' => Middleware\Own::class,
        'root' => Middleware\SuperAdmin::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'localize' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
        'localizationRedirect' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
        'localeSessionRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class
//        'simpleauth' => Middleware\SimpleAuthMiddleware::class,
//        'jwt.auth' => \Tymon\JWTAuth\Middleware\GetUserFromToken::class,
//        'jwt.refresh' => \Tymon\JWTAuth\Middleware\RefreshToken::class
    ];
}
