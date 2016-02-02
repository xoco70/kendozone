<?php

// Home
Breadcrumbs::register('dashboard', function($breadcrumbs)
{
    $breadcrumbs->push('Dashboard', action('DashboardController@index'));
});

// Home > Tournaments
Breadcrumbs::register('tournaments', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans_choice('crud.tournament',2), action('TournamentController@index'));
});
// Home > Create Tournament
Breadcrumbs::register('create_tournament', function($breadcrumbs,$currentModelName)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push(trans('crud.addModel', [ 'currentModelName' => $currentModelName] ), action('TournamentController@index'));
});

// Home > Tournaments > Edit Tournament
Breadcrumbs::register('edit_tournament', function($breadcrumbs, $tournament)
{
    $breadcrumbs->parent('tournaments');
    $breadcrumbs->push($tournament->name, action('TournamentController@edit', [$tournament->id]));
});

// Home > Tournaments > MyTournament > Invite Competitors  //TODO A Completar
Breadcrumbs::register('invite_competitors', function($breadcrumbs, $tournament)
{
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