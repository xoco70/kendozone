<?php

namespace App\Http\Controllers;

use App\Federation;
use App\Http\Requests;
use App\Http\Requests\FederationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Webpatser\Countries\Countries;

class FederationController extends Controller
{
    protected $currentModelName;

    public function __construct()
    {
//        $this->middleware('auth');
        // Fetch the Site Settings object
        $this->currentModelName = Lang::get('core.federation');
        View::share('currentModelName', $this->currentModelName);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $federations = DB::table('federation')
            ->leftJoin('countries', 'Federation.countryId', '=', 'countries.id')
            ->select('federation.*','countries.name as country')
            ->get(); //
        return view('federations.index', compact('federations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $federation=new Federation();
        $countries = Countries::lists('name', 'id');
        return view('federations.create', compact('federation','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $federation = $request->all();
        if (Federation::create($federation))
            Session::flash('flash_message', 'Operación Exitosa!');
        else
            Session::flash('flash_message', 'Operación No realizada!');
        return redirect('federations');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $federation = Federation::findOrFail($id);
        return view('federations.show', compact('federation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $federation = Federation::findOrFail($id);
        $countries = Countries::lists('name', 'id');

        return view('federations.edit', compact('federation','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $federation = Federation::findOrFail($id);
        $federation->update($request->all());
        return redirect("federations");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $federation = Federation::findOrFail($id);
        $federation->delete();
        return redirect("federations");
    }
}
