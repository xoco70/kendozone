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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function () {
    Route::get('/', 'DashboardController@index')->name('root');

    Route::post("category/create", 'CategoryController@store'); // Protected by OAuth2.0
    Route::get("federations", 'FederationController@index',
        ['names' =>['index' => 'federations.index',
            'create' => 'federations.create',
            'edit' => 'federations.edit',
            'store' => 'federations.store',
            'update' => 'federations.update']]);

    Route::get("users/{user}/federations", 'UserController@myFederations'); // Protected by OAuth2.0
    Route::get("users/{user}/federations/{id}/associations", 'UserController@myAssociations'); // Protected by OAuth2.0
    Route::get("users/{user}/associations/{id}/clubs", 'UserController@myClubs'); // Protected by OAuth2.0

    Route::post('users/{user}/uploadAvatar', 'UserController@uploadAvatar'); // Protected by OAuth2.0

    // Restoring
    Route::get('tournaments', 'TournamentController@index')->name('tournaments.index');

    Route::post('tournaments/{tournament}/restore', 'TournamentController@restore'); // Protected by OAuth2.0

    Route::get('users', 'TournamentController@index')->name('users.index');
    Route::post('users/{user}/restore', 'UserController@restore'); // Protected by OAuth2.0



    Route::resource('championships/{championship}/settings', 'ChampionshipSettingsController', // Protected by OAuth2.0
        ['names' => [
            'index' => 'championships.index',
            'create' => 'championships.create',
            'edit' => 'championships.edit',
            'store' => 'championships.store',
            'update' => 'championships.update']]);




});

