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
Route::get('invite/register/{token}', 'InviteController@register');

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



//Route::get('auth/register/users/{userId}/tournaments/{tournamentId}/categories', 'Auth\AuthController@getCategories');

Route::group(['middleware' => ['auth', 'own']],
    function () {

        Route::resource('tournaments', 'TournamentController');
        Route::get('tournaments/{tournamentId}/delete', 'TournamentController@destroyTournament');

        Route::resource('users', 'UserController');
        Route::get('exportUsersExcel', 'UserController@exportUsersExcel');

        Route::resource('tournaments/{tournamentId}/users', 'TournamentUserController');

//        Route::get('tournaments/{tournamentId}/users', 'TournamentController@getUsers');
        Route::get('tournaments/{tournamentId}/categories/{tournamentCategoryId}/users/{userId}/delete', 'TournamentUserController@deleteUser');
            Route::get('tournaments/{tournamentId}/trees/', 'TournamentController@generateTrees');

//        Route::get('tournaments/{tournamentId}/users/create', 'TournamentController@createUser', ['as' => 'tournaments.users.create']);
//        Route::post('tournaments/{tournamentId}/users/', 'TournamentController@postUser');

        Route::resource('tournaments/{tournamentId}/categories', 'CategoryController');
        Route::resource('tournaments/{tournamentId}/categories/{categoryId}/settings', 'CategorySettingsController');
        Route::resource('invites', 'InviteController');

        Route::resource('competitors', 'CompetitorController');
        Route::resource('grade', 'GradeController');
        Route::resource('settings', 'SettingsController');
        Route::resource('country', 'CountryController');

//        Route::resource('places', 'PlaceController');
    });
//        invite/{userId}/register/
        Route::post('invite/{inviteId}/categories', 'InviteController@registerCategories');

Event::listen('illuminate.query', function($query)
{
        var_dump($query);
});

//Route::resource('shinpan', 'ShinpanController');
//Route::resource('clubs', 'ClubController');
//Route::resource('fight', 'FightController');
//Route::resource('team', 'TeamController');
//Route::resource('shiaicategory', 'ShiaiCategoryController');
//Route::resource('associations', 'AssociationController');
//Route::resource('federations', 'FederationController');
