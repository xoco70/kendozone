<?php

// Home
Breadcrumbs::register('dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', action('DashboardController@index'));
});

// Home > Federations
Breadcrumbs::register('federations.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans_choice('core.federation', 2), route('federations.index'));
});

//// Home > Associations
//Breadcrumbs::register('associations.index', function ($breadcrumbs) {
//    $breadcrumbs->parent('dashboard');
//    $breadcrumbs->push(trans_choice('core.association', 2), route('associations.index'));
//});
//
//// Home > Clubs
//Breadcrumbs::register('clubs.index', function ($breadcrumbs) {
//    $breadcrumbs->parent('dashboard');
//    $breadcrumbs->push(trans_choice('core.club', 2), route('clubs.index'));
//});




// Home > Tournaments
Breadcrumbs::register('tournaments.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans_choice('core.tournament', 2), route('tournaments.index'));
});
Breadcrumbs::register('tournaments.deleted', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('core.tournaments_deleted'));
});

// Home > Create Tournament
Breadcrumbs::register('tournaments.create', function ($breadcrumbs, $currentModelName) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('core.addModel', ['currentModelName' => $currentModelName]), route('tournaments.create'));
});

// Home > Tournaments > Edit Tournament
Breadcrumbs::register('tournaments.edit', function ($breadcrumbs, $tournament) {
    $breadcrumbs->parent('tournaments.index');
    if (Auth::user()->canEditTournament($tournament)) {
        $breadcrumbs->push($tournament->name, route('tournaments.edit', $tournament->slug));
    } else {
        $breadcrumbs->push($tournament->name, route('tournaments.show', $tournament->slug));
    }

});
// Home > Invites
Breadcrumbs::register('invites.index', function ($breadcrumbs) {

    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans_choice('core.invitation', 2), route('invites.index'));
});

// Home > Tournaments > MyTournament > Invite Competitors
Breadcrumbs::register('invites.show', function ($breadcrumbs, $tournament) {

    if (Auth::user()->canEditTournament($tournament)) {
        $breadcrumbs->parent('tournaments.edit', $tournament);
    } else {
        $breadcrumbs->parent('tournaments.show', $tournament);
    }

    $breadcrumbs->push(trans('core.invite_competitors'), route('invites.show', $tournament->slug));
});

// Home > Tournaments > MyTournament > List Competitors
Breadcrumbs::register('tournaments.users.index', function ($breadcrumbs, $tournament) {
    $breadcrumbs->parent('tournaments.edit', $tournament);
    $breadcrumbs->push(trans_choice('core.competitor', 2), action('TournamentUserController@index', [$tournament->slug]));
});

// Home > Tournaments > MyTournament > Add Competitors
Breadcrumbs::register('tournaments.users.create', function ($breadcrumbs, $tournament) {
    if (Auth::user()->canEditTournament($tournament)) {
        $breadcrumbs->parent('tournaments.edit', $tournament);
    } else {
        $breadcrumbs->parent('tournaments.show', $tournament);
    }
    $breadcrumbs->push(trans('core.add_competitor'), action('TournamentUserController@create', [$tournament->slug]));
});

// Home > Tournaments > MyTournament > show Competitor
Breadcrumbs::register('tournaments.users.show', function ($breadcrumbs, $tournament, $user) {
    $breadcrumbs->parent('tournaments.users.index', $tournament);
    $breadcrumbs->push($user->name, action('TournamentUserController@index', [$tournament->slug, $user->slug]));
});

// Home > Edit Profile
Breadcrumbs::register('users.edit', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('dashboard');
    if (Auth::user()->canEditUser($user)) {
        $breadcrumbs->push($user->name, route('users.edit', $user->slug));
    } else {
        $breadcrumbs->push($user->name, route('users.show', $user->slug));
    }

});

Breadcrumbs::register('users.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans_choice('core.competitor', 2), route('users.index'));
});

Breadcrumbs::register('users.create', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('core.add_competitor'), route('users.create'));
});

Breadcrumbs::register('users.show', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans_choice('core.user', 1), route('users.show', $user->slug));
});

Breadcrumbs::register('users.tournaments', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('core.tournaments_registered'), route('users.tournaments', $user->slug));


});


Breadcrumbs::register('categories.create', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('core.add_category'), route('categories.create'));
});
