<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Tournament;
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
     * @return View
     */
    public function index()
    {
        $openTournaments = Tournament::with('owner')
            ->whereHas('owner', function ($query) {
                $query->where('country_id', Auth::user()->country_id);
            })
            ->where('type', config('constants.OPEN_TOURNAMENT'))
            ->get();

        return view('/dashboard',compact('openTournaments'));

    }

}
