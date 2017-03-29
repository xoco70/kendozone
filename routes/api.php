<?php

use Illuminate\Http\Request;

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
    Route::get("users/{user}/federations/{id}/associations/{id}/clubs", 'UserController@myClubs');

    Route::post('users/{user}/uploadAvatar', 'UserController@uploadAvatar');

    // Restoring

    Route::post('tournaments/{tournament}/restore', 'TournamentController@restore');


    Route::post('users/{user}/restore', 'UserController@restore');
    Route::get('users', 'UserController@index')->name('users.index');


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

    Route::post('teams/{team}/delete', 'TeamController@destroy')->name('deleteTeam');

    Route::post('associations/create', 'AssociationController@store')->name('createAssociation');
    Route::post('club/create', 'ClubController@store')->name('createClub');

});

