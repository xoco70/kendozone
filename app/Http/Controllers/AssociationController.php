<?php

namespace App\Http\Controllers;

use App\Association;
use App\Http\Requests;
use App\Http\Requests\AssociationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class AssociationController extends Controller
{
    protected $currentModelName;

    public function __construct()
    {
        $this->middleware('auth');
        // Fetch the Site Settings object
        $this->currentModelName = Lang::get('core.association');
        View::share('currentModelName', $this->currentModelName);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $associations = Association::all();
        return view('associations.index', compact('associations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $association = new Association();
        return view('associations.create', compact('association'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssociationRequest $request)
    {
        $association = $request->all();
        if (Association::create($association))
            Session::flash('success', 'Operación Exitosa!');
        else
            Session::flash('error', 'Operación No realizada!');
        return redirect('associations');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $association = Association::findOrFail($id);
        return view('associations.show', compact('association'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $association = Association::findOrFail($id);

        return view('associations.edit', compact('association'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $association = Association::findOrFail($id);
        $association->update($request->all());
        return redirect("associations");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $association = Association::findOrFail($id);
        $association->delete();
        return redirect("associations");
    }
}
