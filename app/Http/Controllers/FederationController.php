<?php

namespace App\Http\Controllers;

use App\Federation;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FederationController extends Controller
{
    protected $currentModelName;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $federations = Federation::with('president','vicepresident','secretary','treasurer','admin')->get();
        return view('federations.index', compact('federations'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $federation = Federation::findOrFail($id);

        return view('federations.edit', compact('federation'));
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
        $association = Federation::findOrFail($id);
        $association->update($request->all());
        return redirect("federations");
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
        return redirect("federations");
    }
}
