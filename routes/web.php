<?php
use Illuminate\Http\Request;

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
//Auth::loginUsingId(3524); // 6 Admin, 5 User

Auth::routes();
Route::impersonate();
Route::get('/impersonate/create', 'ImpersonateController@create')->name('impersonate.create');
Route::post('/impersonate/store', 'ImpersonateController@store')->name('impersonate.store');


Route::get('/test', function(){
    return view('test');
});
// Outside to except show in controller
Route::get('/tournaments/deleted', 'TournamentController@getDeleted')->name('getDeleted'); // Already has auth middleware
Route::resource('tournaments', 'TournamentController');


Route::get('/logout', 'Auth\LoginController@logout');

Route::post('auth/invite', 'Auth\RegisterController@registerFromInvite');


Route::get('/tournaments/{tournamentSlug}/invite/{token}', 'ChampionshipController@create'); //TODO this route has no sense
Route::post('tournaments/{tournament}/invite/{invite}/categories', 'ChampionshipController@store');

Route::get('lang/{lang}', 'LanguageController@update');
Route::get('tournaments/{tournament}/register', 'TournamentController@register')->name('register.category');

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


Route::group(['middleware' => ['auth']], // 'throttle:100,1'
    function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::resource('federations', 'FederationController', ['names' => ['index' => 'federations.index', 'create' => 'federations.create', 'edit' => 'federations.edit', 'store' => 'federations.store', 'update' => 'federations.update']]);
        Route::resource('associations', 'AssociationController');
        Route::resource('clubs', 'ClubController', ['names' => ['index' => 'clubs.index', 'create' => 'clubs.create', 'edit' => 'clubs.edit', 'store' => 'clubs.store', 'update' => 'clubs.update']]);

        Route::resource('categories', 'CategoryController');

        //TODO those routes should not exist -- removing
        Route::resource('/tournaments/{tournament}/teams', 'TeamController', ['names' => ['index' => 'teams.index', 'create' => 'teams.create', 'edit' => 'teams.edit', 'store' => 'teams.store', 'update' => 'teams.update']]);

        Route::resource('users', 'UserController', ['names' => [
            'index' => 'users.index',
            'show' => 'users.show',
            'create' => 'users.create',
            'edit' => 'users.edit',
            'store' => 'users.store',
            'update' => 'users.update'
        ]]);

        Route::get('users/{user}/tournaments', [
            'uses' => 'UserController@getMyTournaments',
            'as' => 'users.tournaments'
        ]);


        Route::get('export', 'UserController@export');
        Route::resource('tournaments/{tournament}/users', 'CompetitorController', ['names' => ['index' => 'tournament.users.index', 'show' => 'tournament.users.show', 'create' => 'tournament.users.create', 'edit' => 'tournament.users.edit', 'store' => 'tournament.users.store', 'update' => 'tournament.users.update']]);
        Route::delete('tournaments/{tournamentId}/categories/{championshipId}/users/{userId}/delete', 'CompetitorController@deleteUser');
        Route::put('tournaments/{tournamentId}/categories/{championshipId}/users/{userId}/confirm', 'CompetitorController@confirmUser');

        Route::resource('invites', 'InviteController', ['names' => ['index' => 'invites.index', 'store' => 'invites.store', 'show' => 'invites.show']]);
        Route::post('invites/upload', 'InviteController@upload');
        Route::get('tournaments/{tournament}/invite', 'InviteController@create');


        Route::post('championships/{championship}/teams', 'TeamController@store')->name('team.store');


        // Other Admin Routes

        Route::get('logs', 'LogsController@index')->name('logs.index');
        Route::get('debug', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('debug.index');


//        Route::get('oauth', function(){
//           return view('auth/oauth2');
//        });

        Route::get('tournaments/{tournament}/trees/', 'TreeController@index')->name('tree.index');
        Route::get('tournaments/{tournament}/fights/', 'FightController@index')->name('fights.index');
        Route::get('championships/{championship}/tree/', 'TreeController@single')->name('tree.single');

        // PDF
        Route::get('championships/{championship}/tree/pdf', 'PDFController@tree')->name('tree_pdf');
        Route::get('championships/{championship}/scoresheet/pdf', 'PDFController@scoresheets')->name('sheet_pdf');

        Route::post('tournaments/{tournament}/trees/', 'TreeController@store')->name('tree.storeAll');
        Route::post('championships/{championshipId}/trees/', 'TreeController@store')->name('tree.store');;
        Route::put('championships/{championshipId}/trees/', 'TreeController@update')->name('tree.update');;

        Route::resource('tournaments/{tournament}/scoresheets', 'ScoreSheetController');


        Route::get('workingonit', function () {
            return view('workingonit');
        })->name('workingonit');



    });
Route::get('/auth/callback', function (Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->post('https://laravel.dev/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => '6',
            'client_secret' => 'A0srL90BUGWT0ATUeFFmDeiqTVkk4sH93PvMp5FS',
            'redirect_uri' => 'http://laravel.dev/auth/callback',
            'code' => $request->code,
        ],
    ]);

    return json_decode((string)$response->getBody(), true);
});


Auth::routes();

Route::get('/auth/oauth', function () {
    return view('auth.oauth');
});

Route::get('/oauth_test', function () {
    return view('oauth_ajax_test');
});

Route::get('/callback', function (Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->post('https://laravel.dev/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => '10',
            'client_secret' => 'LdI1CLUsWOqfsuyGApZSTbns0wQcoSpKE7LRzSPc',
            'redirect_uri' => 'https://laravel.dev/callback',
            'code' => $request->code,
        ],
    ]);

    return json_decode((string)$response->getBody(), true);
});
