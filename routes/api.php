<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix' => 'v1'], function () {
    Route::get('tournaments', 'TournamentController@index')->name('tournaments.index');
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {// Protected by OAuth2.0
    Route::get('/', 'DashboardController@index')->name('root');

    Route::post("category/create", 'CategoryController@store');
    Route::get("federations", 'FederationController@index');

    Route::get("users/{user}/federations", 'UserController@myFederations');
    Route::get("users/{user}/federations/{id}/associations", 'UserController@myAssociations');
    Route::get("users/{user}/federations/{federationId?}/associations/{associationId?}/clubs", 'UserController@myClubs')->name('clubs.my');

    Route::post('users/{user}/uploadAvatar', 'UserController@uploadAvatar');

    // Restoring

    Route::post('tournaments/{tournament}/restore', 'TournamentController@restore')->name('tournaments.restore');


    Route::post('users/{user}/restore', 'UserController@restore')->name('users.restore');
    Route::get('users', 'UserController@index')->name('users.index');

    // TODO Should be posting so nobody can restore tournament
    Route::get('associations/{association}/restore', 'AssociationController@restore');
    Route::get('clubs/{club}/restore', 'ClubController@restore');


    Route::resource('championships/{championship}/settings', 'ChampionshipSettingsController',
        ['names' => [
            'index' => 'championships.index',
            'create' => 'championships.create',
            'edit' => 'championships.edit',
            'store' => 'championships.store',
            'update' => 'championships.update']]);


    Route::post('teams/{team}/competitors/{competitor}/add', 'CompetitorTeamController@store')->name('addCompetitorToTeam');
    Route::post('teams/{team}/competitors/{competitor}/remove', 'CompetitorTeamController@destroy')->name('removeCompetitorToTeam');
    Route::post('teams/{team1}/{team2}/competitors/{competitor}/move', 'CompetitorTeamController@update')->name('moveCompetitorToAnotherTeam');

    Route::post('teams/{team}/delete', 'TeamController@destroy')->name('teams.delete');

    Route::post('associations/create', 'AssociationController@store')->name('associations.create');
    Route::post('club/create', 'ClubController@store')->name('clubs.create');

});

