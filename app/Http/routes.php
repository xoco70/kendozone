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
use App\Grade;

get('seed', function () {
    Grade::truncate();
    Grade::create(['id' => '10','name' => "5 Kyu",'order' => 2]);
});
//Route::get('/tournaments', 'TournamentsController@index');
//Route::get('/tournaments/create', 'TournamentsController@create');
//Route::get('/tournaments/{id}', 'TournamentsController@show');
//Route::post('/tournaments', 'TournamentsController@store');
//Route::resource('tournaments','TournamentsController');
// Authentication routes...

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::controllers([
    'password' => 'Auth\PasswordController',
]);

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/', ['uses' => 'DashboardController@index']);
//Route::get('/',['middleware' => 'guest'], 'DashboardController');


Route::resource('tournaments', 'TournamentController');
Route::resource('competitors', 'CompetitorController');


Route::resource('clubs', 'ClubController');

Route::resource('shinpan', 'ShinpanController');
Route::resource('users', 'UserController');
Route::resource('country', 'CountryController');

Route::resource('fight', 'FightController');
Route::resource('team', 'TeamController');
Route::resource('places', 'PlaceController');
Route::resource('shiaicategory', 'ShiaiCategoryController');
Route::resource('grade', 'GradeController');

Route::resource('associations', 'AssociationController');
Route::resource('federations', 'FederationController');
