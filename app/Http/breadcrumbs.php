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

// Home > Tournaments > MyTournament > Add Competitors
Breadcrumbs::register('tournaments.users.index', function ($breadcrumbs, $tournament) {
    $breadcrumbs->parent('tournaments.edit',$tournament);
    $breadcrumbs->push(trans('crud.add_competitors'), route('tournaments.users.index', $tournament->id));
});

// Home > Tournaments > MyTournament > Add Competitors  //TODO A Completar
Breadcrumbs::register('create_tournament_users', function ($breadcrumbs, $tournament) {
    $breadcrumbs->parent('tournaments');
    $breadcrumbs->push(trans('crud.invite_competitors'), action('TournamentController@edit', [$tournament->id]));
});

// Home > Tournaments > MyTournament > Add Competitors  //TODO A Completar
Breadcrumbs::register('edit_tournament_users', function ($breadcrumbs, $tournament) {
    $breadcrumbs->parent('tournaments');
    $breadcrumbs->push(trans('crud.invite_competitors'), action('TournamentController@edit', [$tournament->id]));
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