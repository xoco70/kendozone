<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use OwenIt\Auditing\Log;

class LogsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logs = Log::latest()->take(2)->get();//paginate(50);
        $logs = Log::latest()->paginate(50);
//        dd($logs);
        return view('logs.index', compact('logs'));
    }


}
