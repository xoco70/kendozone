<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    protected $currentModelName;

    public function __construct()
    {
//        dd( Session::get('locale'));
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

//        $myTournaments = Auth::user()->getMyTournaments();

//        $past_tournaments = Auth::user()->tournaments()
//                                    ->where('dateFin','<', new \DateTime('today'))
//                                    ->get();
//        dd($myTournaments);
        return view('/dashboard');

    }

}
