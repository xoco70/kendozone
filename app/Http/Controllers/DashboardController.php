<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Place;
use GeoIP;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    protected $currentModelName;

    public function __construct()
    {
        // Fetch the Site Settings object
        $this->currentModelName = trans_choice('core.dashboard', 1);
        View::share('currentModelName', $this->currentModelName);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd(Auth::user()->tcs);
//        $ip = $_SERVER["REMOTE_ADDR"];
//        $location = GeoIP::getLocation("189.209.75.100"); // Simulating IP in Mexico DF
//        dd($location['isoCode']);
//        dd($location);

//        $myTournament = Auth::getUser()->hasAtLeastOneTournament();
//        $activeTournament = Auth::getUser()->tournaments()->where("");
//        $incompleteTournament = Auth::getUser()->tournaments()->where("");
//        dd($myTournament);
        return view('/dashboard');

    }

}
