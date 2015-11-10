<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompetitorRequest;
use App\Competitor;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Webpatser\Countries\Countries;

class CompetitorController extends Controller
{
    protected $currentModelName;

    public function __construct()
    {
        $this->middleware('auth');
        // Fetch the Site Settings object
        $this->currentModelName = Lang::get('crud.competitor');
        View::share('currentModelName', $this->currentModelName);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competitors = DB::table('competitor')
            ->leftJoin('countries', 'competitor.countryId', '=', 'countries.id')
            ->select('competitor.*','countries.name as country')
            ->get(); //
        return view('competitors.index', compact('competitors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $competitor=new Competitor();
        $countries = Countries::lists('name', 'id');
        return view('competitors.create', compact('competitor','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompetitorRequest $request)
    {
        $competitor = $request->all();
        if (Competitor::create($competitor))
            Session::flash('flash_message', 'Operación Exitosa!');
        else
            Session::flash('flash_message', 'Operación No realizada!');
        return redirect('competitors');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Competitor $competitor)
    {
        return view('competitors.show', compact('competitor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Competitor $competitor)
    {
        $countries = Countries::lists('name', 'id');

        return view('competitors.edit', compact('competitor','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competitor $competitor)
    {
        $competitor->update($request->all());
        return redirect("competitors");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competitor $competitor)
    {
        $competitor->delete();
        return redirect("competitors");
    }
}
