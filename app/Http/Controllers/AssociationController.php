<?php

namespace App\Http\Controllers;

use App\Association;
use App\Federation;
use App\Http\Requests;
use App\Http\Requests\FederationRequest;
use App\User;
use Illuminate\Http\Request;

class AssociationController extends Controller
{
    protected $currentModelName;
    // Only Super Admin and Federation President can manage Federations

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $associations = Association::with('president')->get(); // ,'vicepresident','secretary','treasurer','admin'
        return view('associations.index', compact('associations'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $association = Federation::findOrFail($id);
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
        $association = Federation::findOrFail($id);
        $users = User::where('country_id','=', $association->country_id)->get();

        return view('associations.edit', compact('association','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(FederationRequest $request, $id)
    {

        $association = Federation::findOrFail($id);
        $association->update($request->all());
        $msg = trans('msg.association_edit_successful', ['name' => $association->name]);
        flash()->success($msg);
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
        $association = Federation::findOrFail($id);
        $association->delete();
        return redirect("associations");
    }
}
