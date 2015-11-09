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

# Static Pages. Redirecting admin so admin cannot access these pages.
Route::group(['middleware' => ['redirectAdmin']], function()
{
    Route::get('/', ['as' => 'home', 'uses' => 'PagesController@getHome']);
    Route::get('about', ['as' => 'about', 'uses' => 'PagesController@getAbout']);
    Route::get('contact', ['as' => 'contact', 'uses' => 'PagesController@getContact']);
});

# Registration
Route::group(['middleware' => 'guest'], function()
{
    Route::get('register', 'RegistrationController@create');
    Route::post('register', ['as' => 'registration.store', 'uses' => 'RegistrationController@store']);
});

# Authentication
Route::get('login', ['as' => 'login', 'middleware' => 'guest', 'uses' => 'SessionsController@create']);
Route::get('logout', ['as' => 'logout', 'uses' => 'SessionsController@destroy']);
Route::resource('sessions', 'SessionsController' , ['only' => ['create','store','destroy']]);

# Forgotten Password
Route::group(['middleware' => 'guest'], function()
{
    Route::get('forgot_password', 'Auth\PasswordController@getEmail');
    Route::post('forgot_password','Auth\PasswordController@postEmail');
    Route::get('reset_password/{token}', 'Auth\PasswordController@getReset');
    Route::post('reset_password/{token}', 'Auth\PasswordController@postReset');
});

# Standard User Routes
Route::group(['middleware' => ['auth','standardUser']], function()
{
    Route::get('userProtected', 'StandardUser\StandardUserController@getUserProtected');
    Route::resource('profiles', 'StandardUser\UsersController', ['only' => ['show', 'edit', 'update']]);
});

# Admin Routes
Route::group(['middleware' => ['auth', 'admin']], function()
{
    Route::get('admin', ['as' => 'admin_dashboard', 'uses' => 'Admin\AdminController@getHome']);
    Route::resource('admin/profiles', 'Admin\AdminUsersController', ['only' => ['index', 'show', 'edit', 'update', 'destroy']]);
});


//get('seed', function () {
//    // Register a new user
//    Sentinel::register([
//        'email'    => 'test@example.com',
//        'password' => 'foobar',
//    ]);
//});
//Route::get('/tournaments', 'TournamentsController@index');
//Route::get('/tournaments/create', 'TournamentsController@create');
//Route::get('/tournaments/{id}', 'TournamentsController@show');
//Route::post('/tournaments', 'TournamentsController@store');
//Route::resource('tournaments','TournamentsController');
// Authentication routes...

// Authentication routes...
//Route::get('auth/login', 'Auth\AuthController@getLogin');
//Route::post('auth/login', 'Auth\AuthController@postLogin');
//Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
//Route::get('auth/register', 'Auth\AuthController@getRegister');
//Route::post('auth/register', 'Auth\AuthController@postRegister');
//
//
//Route::controllers([
//    'password' => 'Auth\PasswordController',
//]);

Route::get('/home', function () {
    return view('welcome');
});

//Route::get('/', ['uses' => 'DashboardController@index']);
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
