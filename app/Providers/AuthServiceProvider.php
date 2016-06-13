<?php

namespace App\Providers;

use App\Association;
use App\Club;
use App\Federation;
use App\Policies\AssociationPolicy;
use App\Policies\ClubPolicy;
use App\Policies\FederationPolicy;
use App\Policies\UserPolicy;
use App\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

        User::class => UserPolicy::class,
        Federation::class => FederationPolicy::class,
        Association::class => AssociationPolicy::class,
        Club::class => ClubPolicy::class,

    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

    }

}
