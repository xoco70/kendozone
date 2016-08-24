<?php

namespace App\Providers;

use App\Association;
use App\Club;
use App\Federation;
use App\Team;
use App\Tournament;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Tournament::class => TournamentPolicy::class,
        User::class => UserPolicy::class,
        Federation::class => FederationPolicy::class,
        Association::class => AssociationPolicy::class,
        Club::class => ClubPolicy::class,
        Team::class => TeamPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
