<?php

// Home
Breadcrumbs::register('dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', action('DashboardController@index'));
});

// Home > Tournaments
Breadcrumbs::register('tournaments.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans_choice('crud.tournament', 2), route('tournaments.index'));
});
// Home > Create Tournament
Breadcrumbs::register('tournaments.create', function ($breadcrumbs, $currentModelName) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('crud.addModel', ['currentModelName' => $currentModelName]), route('tournaments.create'));
});

// Home > Tournaments > Edit Tournament
Breadcrumbs::register('tournaments.edit', function ($breadcrumbs, $tournament) {
    $breadcrumbs->parent('tournaments.index');
    $breadcrumbs->push($tournament->name, route('tournaments.edit', $tournament->id));
});

// Home > Tournaments > MyTournament > Invite Competitors
Breadcrumbs::register('invites.show', function ($breadcrumbs, $tournament) {

    $breadcrumbs->parent('tournaments.edit', $tournament);
    $breadcrumbs->push(trans('crud.invite_competitors'), route('invites.show', $tournament->id));
});

// Home > Tournaments > MyTournament > List Competitors
Breadcrumbs::register('tournaments.users.index', function ($breadcrumbs, $tournament) {
    $breadcrumbs->parent('tournaments.edit',$tournament);
    $breadcrumbs->push(trans_choice('crud.competitor',2), action('TournamentUserController@index', [$tournament->id]));
});

// Home > Tournaments > MyTournament > Add Competitors  //TODO A Completar
Breadcrumbs::register('tournaments.users.create', function ($breadcrumbs, $tournament) {
    $breadcrumbs->parent('tournaments.edit',$tournament);
    $breadcrumbs->push(trans('crud.add_competitor'), action('TournamentController@create', [$tournament->id]));
});

// Home > Tournaments > MyTournament > show Competitor
Breadcrumbs::register('tournaments.users.show', function ($breadcrumbs, $tournament, $user) {
    $breadcrumbs->parent('tournaments.users.index', $tournament);
    $breadcrumbs->push($user->name, action('TournamentUserController@index', [$tournament->id, $user->id]));
});

// Home > Edit Profile
Breadcrumbs::register('users.edit', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push($user->name, route('users.edit', $user->id));
});

Breadcrumbs::register('users.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans_choice('crud.competitor',2), route('users.index'));
});

Breadcrumbs::register('users.create', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('crud.add_competitor'), route('users.create'));
});

Breadcrumbs::register('users.show', function ($breadcrumbs, $tournament) {
    $breadcrumbs->parent('tournaments');
    $breadcrumbs->push(trans('crud.invite_competitors'), route('users.show', $tournament->id));
});

//// Home > Blog > [Category]
//Breadcrumbs::register('category', function($breadcrumbs, $category)
//{
//    $breadcrumbs->parent('blog');
//    $breadcrumbs->push($category->title, route('category', $category->id));
//});
//
//// Home > Blog > [Category] > [Page]
//Breadcrumbs::register('page', function($breadcrumbs, $page)
//{
//    $breadcrumbs->parent('category', $page->category);
//    $breadcrumbs->push($page->title, route('page', $page->id));
//});