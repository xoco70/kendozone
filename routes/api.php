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
    Route::get('/', 'DashboardController@index')->name('api.root');

    Route::post("category/create", 'CategoryController@store');
    Route::get("federations", 'FederationController@index', ['names' => ['index' => 'api.federations.index', 'create' => 'api.federations.create', 'edit' => 'api.federations.edit', 'store' => 'api.federations.store', 'update' => 'api.federations.update']]);
    Route::get("users/{user}/federations/", 'UserController@myFederations');
    Route::get("users/{user}/federations/{id}/associations", 'UserController@myAssociations');
    Route::get("users/{user}/associations/{id}/clubs", 'UserController@myClubs');

    Route::post('users/{user}/uploadAvatar', 'UserController@uploadAvatar');

    // Restoring
    Route::get('tournaments', 'TournamentController@index')->name('tournaments.api');

    Route::post('tournaments/{tournament}/restore', 'TournamentController@restore');

    Route::get('users', 'TournamentController@index')->name('users.api')->middleware('auth:api');
    Route::post('users/{user}/restore', 'UserController@restore');



    Route::resource('championships/{championship}/settings', 'ChampionshipSettingsController',
        ['names' => [
            'index' => 'api.championships.index',
            'create' => 'api.championships.create',
            'edit' => 'api.championships.edit',
            'store' => 'api.championships.store',
            'update' => 'api.championships.update']]);




});

