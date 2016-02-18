<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Auth::loginUsingId(6); // 6 Admin, 5 User

// Authentication routes...
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::post('auth/invite', 'Auth\AuthController@postInvite');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

//Route::get('/', function () {
//    return Redirect::to('/frontend');
//});
Route::get('/', 'DashboardController@index')->middleware(['auth']);
Route::get('/admin', 'DashboardController@index')->middleware(['auth']);
//Route::get('/dashboard', 'DashboardController@index')->middleware(['auth']);
//Route::get('/users/{id}/edit', 'UserController@edit')->middleware(['auth']);
Route::get('/tournaments/{tournamentId}/invite/{token}', 'InviteController@register');
Route::post('tournaments/{tournament}/invite/{inviteId}/categories', 'InviteController@registerCategories');

Route::group(['middleware' => ['guest']],
    function () {
        Route::post('auth/login', 'Auth\AuthController@postLogin');
        Route::get('auth/login', 'Auth\AuthController@getLogin');

        // Registration routes...

        Route::get('auth/register', 'Auth\AuthController@getRegister');
        Route::post('auth/register', 'Auth\AuthController@postRegister');
        Route::get('auth/register/confirm/{token}', 'Auth\AuthController@confirmEmail');


        //Social Login
        Route::get('auth/login/{provider?}', [
            'uses' => 'Auth\AuthController@getSocialAuth',
            'as' => 'auth.getSocialAuth'
        ]);


        Route::get('/login/callback/{provider?}', [
            'uses' => 'Auth\AuthController@getSocialAuthCallback',
            'as' => 'auth.getSocialAuthCallback'
        ]);
    });


Route::group(['middleware' => ['auth', 'own', ]], // , 'own' // 'throttle:100,1'
    function () {

        Route::resource('tournaments', 'TournamentController');
        Route::get('tournaments/{tournament}/register', 'TournamentController@register');

        Route::resource('users', 'UserController');
        Route::get('exportUsersExcel', 'UserController@exportUsersExcel');

        Route::resource('tournaments/{tournament}/users', 'TournamentUserController');


//        Route::get('tournaments/{tournamentId}/users', 'TournamentController@getUsers');
        Route::delete('tournaments/{tournamentId}/categories/{categoryTournamentId}/users/{userId}/delete', 'TournamentUserController@deleteUser');
        Route::put('tournaments/{tournamentId}/categories/{categoryTournamentId}/users/{userId}/confirm', 'TournamentUserController@confirmUser');

            Route::get('tournaments/{tournamentId}/trees/', 'TournamentController@generateTrees');

//        Route::get('tournaments/{tournamentId}/users/create', 'TournamentController@createUser', ['as' => 'tournaments.users.create']);
//        Route::post('tournaments/{tournamentId}/users/', 'TournamentController@postUser');

        Route::resource('tournaments/{tournament}/categories', 'CategoryController');
        Route::resource('tournaments/{tournamentId}/categories/{categoryId}/settings', 'CategorySettingsController');
        Route::resource('invites', 'InviteController');
        Route::get('tournaments/{tournament}/invite', 'InviteController@inviteUsers');

//        Route::resource('competitors', 'CompetitorController');
//        Route::resource('grade', 'GradeController');
        Route::resource('settings', 'SettingsController');




        //Restoring
        Route::get('tournaments/{tournament}/restore', 'TournamentController@restore');
        Route::get('users/{user}/restore', 'UserController@restore');





    });
//APIS
Route::group(['prefix' => 'api/v1'], function () { // , 'middleware' => 'AuthApi', 'middleware' => 'simpleauth'
        Route::get('authenticate', 'Api\AuthenticateController@index');
        Route::post('authenticate', 'Api\AuthenticateController@authenticate');
        Route::resource('tournaments', 'Api\TournamentController');
});
//        invite/{userId}/register/


//Event::listen('illuminate.query', function($query)
//{
//        var_dump($query);
//});

//Route::resource('shinpan', 'ShinpanController');
//Route::resource('clubs', 'ClubController');
//Route::resource('fight', 'FightController');
//Route::resource('team', 'TeamController');
//Route::resource('shiaicategory', 'ShiaiCategoryController');
//Route::resource('associations', 'AssociationController');
//Route::resource('federations', 'FederationController');
