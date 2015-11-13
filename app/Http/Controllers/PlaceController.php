<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceRequest;
use App\Place;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Webpatser\Countries\Countries;

class PlaceController extends Controller
{
    protected $currentModelName;

    public function __construct()
    {
//        $this->middleware('auth');
        // Fetch the Site Settings object
        $this->currentModelName = Lang::get('crud.place');
        View::share('currentModelName', $this->currentModelName);

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $places = DB::table('place')
            ->leftJoin('countries', 'place.countryId', '=', 'countries.id')
            ->select('place.*','countries.name as country')
            ->get(); //
        return view('places.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $place=new Place();
        $countries = Countries::lists('name', 'id');
        return view('places.create', compact('place','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(PlaceRequest $request)
    {
        $place = $request->all();
        if (Place::create($place))
            Session::flash('flash_message', 'Operación Exitosa!');
        else
            Session::flash('flash_message', 'Operación No realizada!');
        return redirect('places');
    }

    /**
     * Display the specified resource.
     *
     * @param Place $place
     * @return Response
     */
    public function show(Place $place)
    {
        return view('places.show', compact('place'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Place $place
     * @return Response
     */
    public function edit(Place $place)
    {

        $countries = Countries::lists('name', 'id');

        return view('places.edit', compact('place','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Place $place
     * @return Response
     */
    public function update(Request $request,Place $place)
    {
        $place->update($request->all());
        return redirect("places");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Place $place)
    {
        $place->delete();
        return redirect("places");
    }
}
