<?php

namespace App\Http\Controllers\Auth;

use App\AuthenticateUser;
use App\Http\Controllers\Controller;
use App\LocaliseAPI;
use File;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    public function showLoginForm()
    {
        $langStats = [
            "en" => $this->getLangWordsCount('lang/en'),
            "fr" => $this->getLangWordsCount('lang/fr'),
            "es" => $this->getLangWordsCount('lang/es'),
            "ja" => $this->getLangWordsCount('lang/ja'),
        ];
        $api = new LocaliseAPI(env('LOCALISE_API_KEY'), ENV('LOCALISE_PROJECT'));
        $api->listLangsInProject();


        return view('auth.login', compact('langStats'));
    }
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    /**
     * @var Socialite
     */
    private $socialite;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Socialite $socialite)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->socialite = $socialite;
    }

    public function getSocialAuth(AuthenticateUser $authenticateUser, Request $request, $provider = null)
    {

        return $authenticateUser->execute($request->all(), $this, $provider);
    }

    /**
     * @return int
     */
    protected function getLangWordsCount($folder): int
    {
        $files = File::allFiles(resource_path($folder));
        // Open English folder to get 100% reference
        $completeCount = 0;
        foreach ($files as $file) {
            $content = File::get($file);
            $completeCount += substr_count($content, '=>');

        }
        return $completeCount;
    }

}
