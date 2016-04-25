<?php

namespace App\Http\Controllers;

use App\Http\Requests;
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

        return view('/dashboard');

    }

}
