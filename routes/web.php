<?php
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

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




Route::post('auth/invite', 'Auth\RegisterController@registerFromInvite');


Route::get('/tournaments/{tournamentSlug}/invite/{token}', 'ChampionshipController@create'); //TODO this route has no sense
Route::post('tournaments/{tournament}/invite/{invite}/categories', 'ChampionshipController@store');

Route::get('lang/{lang}', 'LanguageController@update');

Route::group(['middleware' => ['guest']],
    function () {

        // Registration routes...

        Route::get('register/confirm/{token}', 'Auth\RegisterController@confirmEmail');

        //Social Login
        Route::get('/login/{provider?}', [
            'uses' => 'Auth\LoginController@getSocialAuth',
            'as' => 'auth.getSocialAuth'
        ]);


        Route::get('/login/callback/{provider?}', [
            'uses' => 'Auth\LoginController@getSocialAuthCallback',
            'as' => 'auth.getSocialAuthCallback'
        ]);
    });


//Route::get('/admin', 'DashboardController@index')->middleware(['auth']);

Route::get('tournaments/deleted', 'TournamentController@getDeleted');

Route::group(['middleware' => ['auth']], // 'throttle:100,1'
    function () {
        Route::get('/', 'DashboardController@index');
        Route::resource('federations', 'FederationController', ['names' => ['index' => 'federations.index', 'create' => 'federations.create', 'edit' => 'federations.edit', 'store' => 'federations.store', 'update' => 'federations.update']]);
        Route::resource('associations', 'AssociationController');
        Route::resource('clubs', 'ClubController');

        Route::resource('tournaments', 'TournamentController', ['names' => ['index' => 'tournaments.index', 'show' => 'tournaments.show', 'create' => 'tournaments.create', 'edit' => 'tournaments.edit', 'store' => 'tournaments.store', 'update' => 'tournaments.update']]);
        Route::resource('categories', 'CategoryController');
        Route::resource('/tournaments/{tournament}/teams', 'TeamController', ['names' => ['index' => 'teams.index', 'create' => 'teams.create', 'edit' => 'teams.edit', 'store' => 'teams.store', 'update' => 'teams.update']]);
        Route::get('tournaments/{tournament}/register', 'TournamentController@register');

        Route::resource('users', 'UserController', ['names' => ['index' => 'users.index', 'show' => 'users.show', 'create' => 'users.create', 'edit' => 'users.edit', 'store' => 'users.store', 'update' => 'users.update']]);

        Route::get('users/{user}/tournaments', [
            'uses' => 'UserController@getMyTournaments',
            'as' => 'users.tournaments'
        ]);


        Route::get('export', 'UserController@export');
        Route::resource('tournaments/{tournament}/users', 'CompetitorController', ['names' => ['index' => 'tournament.users.index', 'show' => 'tournament.users.show', 'create' => 'tournament.users.create', 'edit' => 'tournament.users.edit', 'store' => 'tournament.users.store', 'update' => 'tournament.users.update']]);
        Route::delete('tournaments/{tournamentId}/categories/{championshipId}/users/{userId}/delete', 'CompetitorController@deleteUser');
        Route::put('tournaments/{tournamentId}/categories/{championshipId}/users/{userId}/confirm', 'CompetitorController@confirmUser');
        Route::get('tournaments/{tournamentId}/trees/', 'TournamentController@generateTrees');
        Route::resource('tournaments/{tournament}/categories/{category}/settings', 'CategorySettingsController', ['names' => ['index' => 'category.settings.index', 'create' => 'category.settings.create', 'edit' => 'category.settings.edit', 'store' => 'category.settings.store', 'update' => 'category.settings.update']]);
        Route::resource('invites', 'InviteController', ['names' => ['index' => 'invites.index', 'store' => 'invites.store', 'show' => 'invites.show']]);
        Route::get('tournaments/{tournament}/invite', 'InviteController@create');
//        Route::resource('settings', 'SettingsController');

        //Restoring -- TODO Should be posting so nobody can restore tournament
        Route::get('users/{user}/restore', 'UserController@restore');
        Route::get('associations/{association}/restore', 'AssociationController@restore');
        Route::get('clubs/{club}/restore', 'ClubController@restore');


        Route::get('logs', 'LogsController@index');
    });
