<?php

namespace App\Http\Controllers;

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
        $logs = Log::latest()->paginate(50);

        return view('logs.index', compact('logs'));
    }


}
