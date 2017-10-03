<?php

// Home
use Illuminate\Support\Facades\Auth;

Breadcrumbs::register('dashboard', function ($breadcrumbs) {
    $breadcrumbs->push(trans('core.dashboard'), route('dashboard'));
});

// Home > Federations
Breadcrumbs::register('federations.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans_choice('structures.federation', 2), route('federations.index'));
});

Breadcrumbs::register('federations.edit', function ($breadcrumbs, $federation) {
    $breadcrumbs->parent('federations.index');
    if (Auth::user()->isFederationPresident($federation)) {
        $breadcrumbs->push($federation->name, route('federations.edit', $federation->id));
    } else {
        $breadcrumbs->push($federation->name, route('federations.show', $federation->id));
    }

});

// Home > Associations
Breadcrumbs::register('associations.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans_choice('structures.association', 2), route('associations.index'));
});

Breadcrumbs::register('associations.create', function ($breadcrumbs) {
    $breadcrumbs->parent('associations.index');
    $breadcrumbs->push(trans('core.addModel', ['currentModelName' => trans_choice('structures.association', 1)]), route('associations.create'));

});


Breadcrumbs::register('associations.edit', function ($breadcrumbs, $association) {
    $breadcrumbs->parent('associations.index');
    if (Auth::user()->isFederationPresident($association->federation) || Auth::user()->isAssociationPresident($association)) {
        $breadcrumbs->push($association->name, route('associations.edit', $association->id));
    } else {
        $breadcrumbs->push($association->name, route('associations.show', $association->id));
    }

});

//
// Home > Clubs
Breadcrumbs::register('clubs.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans_choice('structures.club', 2), route('clubs.index'));
});

Breadcrumbs::register('clubs.edit', function ($breadcrumbs, $club) {
    $breadcrumbs->parent('clubs.index');
    if (Auth::user()->isFederationPresident($club->federation) || Auth::user()->isAssociationPresident($club) || Auth::user()->isClubPresident($club)) {
        $breadcrumbs->push($club->name, route('clubs.edit', $club->id));
    } else {
        $breadcrumbs->push($club->name, route('clubs.show', $club->id));
    }

});


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
    $breadcrumbs->push(trans('core.createTournament'), route('tournaments.create'));
});

// Home > Tournaments > Edit Tournament
Breadcrumbs::register('tournaments.edit', function ($breadcrumbs, $tournament) {
    $breadcrumbs->parent('tournaments.index');
    if (policy($tournament)->edit(Auth::user(), $tournament)) {
        $breadcrumbs->push($tournament->name, route('tournaments.edit', $tournament->slug));
    } else {
        $breadcrumbs->push($tournament->name, route('tournaments.show', $tournament->slug));
    }

});
Breadcrumbs::register('tournaments.show', function ($breadcrumbs, $tournament) {
    $breadcrumbs->parent('tournaments.index');
    $breadcrumbs->push($tournament->name, route('tournaments.show', $tournament->slug));

});


// Home > Invites
Breadcrumbs::register('invites.index', function ($breadcrumbs) {

    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans_choice('core.invitation', 2), route('invites.index'));
});

// Home > Tournaments > MyTournament > Invite Competitors
Breadcrumbs::register('invites.show', function ($breadcrumbs, $tournament) {
    if ($tournament != null) {
        if (policy($tournament)->edit(Auth::user(), $tournament)) {
            $breadcrumbs->parent('tournaments.edit', $tournament);
        } else {
            $breadcrumbs->parent('tournaments.show', $tournament);
        }
        $breadcrumbs->push(trans('core.invite_competitors'), route('invites.show', $tournament->slug));
    }


});

// Home > Tournaments > MyTournament > List Competitors
Breadcrumbs::register('tournaments.users.index', function ($breadcrumbs, $tournament) {
    $breadcrumbs->parent('tournaments.edit', $tournament);
    $breadcrumbs->push(trans_choice('core.competitor', 2), action('CompetitorController@index', [$tournament->slug]));
});

// Home > Tournaments > MyTournament > Add Competitors
Breadcrumbs::register('tournaments.users.create', function ($breadcrumbs, $tournament) {
    if (policy($tournament)->edit(Auth::user(), $tournament)) {
        $breadcrumbs->parent('tournaments.edit', $tournament);
    } else {
        $breadcrumbs->parent('tournaments.show', $tournament);
    }
    $breadcrumbs->push(trans('core.add_competitor'), action('CompetitorController@create', [$tournament->slug]));
});

// Home > Tournaments > MyTournament > show Competitor
Breadcrumbs::register('tournaments.users.show', function ($breadcrumbs, $tournament, $user) {
    $breadcrumbs->parent('tournaments.users.index', $tournament);
    $breadcrumbs->push($user->name, action('CompetitorController@index', [$tournament->slug, $user->slug]));
});

// Home > Edit Profile
Breadcrumbs::register('users.edit', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('dashboard');
    if (policy($user)->edit(Auth::user(), $user)) {
        if (Auth::user()->name == $user->name) {
            $breadcrumbs->push(trans('core.profile'), route('users.edit', $user->slug));
        } else {
            $breadcrumbs->push($user->name, route('users.show', $user->slug));
        }
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

// Home > Tournaments > MyTournament > List Teams
Breadcrumbs::register('teams.index', function ($breadcrumbs, $tournament) {
    $breadcrumbs->parent('tournaments.edit', $tournament);
    if (policy($tournament)->edit(Auth::user(), $tournament)) {
        $breadcrumbs->push(trans_choice('core.team', 2), route('tournaments.edit', $tournament->slug));
    } else {
        $breadcrumbs->push(trans_choice('core.team', 2), route('tournaments.show', $tournament->slug));
    }

});

// Home > Tournaments > MyTournament > List Trees
Breadcrumbs::register('trees.index', function ($breadcrumbs, $tournament) {
    if (policy($tournament) != null && policy($tournament)->edit(Auth::user(), $tournament)) {
        $breadcrumbs->parent('tournaments.edit', $tournament);
        $breadcrumbs->push(trans_choice('core.tree', 2), route('tournaments.edit', $tournament->slug));
    } else {
        $breadcrumbs->parent('tournaments.show', $tournament);
        $breadcrumbs->push(trans_choice('core.tree', 2), route('tournaments.show', $tournament->slug));
    }

});


Breadcrumbs::register('teams.create', function ($breadcrumbs, $tournament) {
    $breadcrumbs->parent('tournaments.edit', $tournament);
    $breadcrumbs->push(trans_choice('core.team', 2), route('teams.index', $tournament->slug));
});
Breadcrumbs::register('teams.edit', function ($breadcrumbs, $tournament) {
    $breadcrumbs->parent('teams.index', $tournament);
    $breadcrumbs->push(trans_choice('core.team', 2), route('teams.index', $tournament->slug));
});

// Home > Tournaments > MyTournament > List Fights
Breadcrumbs::register('fights.index', function ($breadcrumbs, $tournament) {
    if (policy($tournament)->edit(Auth::user(), $tournament)) {
        $breadcrumbs->parent('tournaments.edit', $tournament);
        $breadcrumbs->push(trans_choice('core.fight', 2), route('tournaments.edit', $tournament->slug));
    } else {
        $breadcrumbs->parent('tournaments.show', $tournament);
        $breadcrumbs->push(trans_choice('core.fight', 2), route('tournaments.show', $tournament->slug));
    }

});

// Home > Tournaments > MyTournament > List Fights
Breadcrumbs::register('scoresheet.index', function ($breadcrumbs, $tournament) {
    if (policy($tournament)->edit(Auth::user(), $tournament)) {
        $breadcrumbs->parent('tournaments.edit', $tournament);
        $breadcrumbs->push(trans_choice('core.fight', 2), route('tournaments.edit', $tournament->slug));
    } else {
        $breadcrumbs->parent('tournaments.show', $tournament);
        $breadcrumbs->push(trans_choice('core.fight', 2), route('tournaments.show', $tournament->slug));
    }

});
