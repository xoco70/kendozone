<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen('TournamentUpdated', function ($tournament) {
            $treeParams = ['prelim', 'winners_per_group', 'tree_type', 'group_size', 'areas'];
            if (array_intersect(array_keys($tournament->getChanges()), $treeParams)) {
                $tournament->resetTree();
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
