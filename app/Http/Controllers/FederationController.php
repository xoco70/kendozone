<?php

namespace App\Http\Controllers;


use App\Exceptions\NotOwningFederationException;
use App\Federation;
use App\Http\Requests;
use App\Http\Requests\FederationRequest;
use App\User;
use Illuminate\Contracts\Validation\UnauthorizedException;
use Illuminate\Support\Facades\Auth;
use URL;

class FederationController extends Controller
{

    protected $currentModelName;
    // Only Super Admin can manage Federations

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $federations = Federation::with('president', 'country')->get(); // ,'vicepresident','secretary','treasurer','admin'
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
     * @param Federation $federation
     * @return \Illuminate\Http\Response
     * @throws NotOwningFederationException
     */
    public function edit($id)
    {
        $federation = Federation::findOrFail($id);
        if (Auth::user()->cannot('edit', $federation)) {
            throw new UnauthorizedException();
        }
        $users = User::where('country_id', '=', $federation->country_id)->lists('name', 'id');
        return view('federations.edit', compact('federation', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FederationRequest|\Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws NotOwningFederationException
     */
    public function update(FederationRequest $request, $id)
    {
        $federation = Federation::findOrFail($id);
        if (Auth::user()->cannot('update', $federation)) {
            throw new NotOwningFederationException();
        }
        $federation->update($request->all());
        $users = User::where('country_id', '=', $federation->country_id)->lists('name', 'id');
        $msg = trans('msg.federation_edit_successful', ['name' => $federation->name]);
        flash()->success($msg);

        return redirect(URL::action('FederationController@edit', $federation->id))->with('users');
    }

}
