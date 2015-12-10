<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceRequest;
use App\Place;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use GeoIP;
use Webpatser\Countries\Countries;

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
