<?php

namespace App\Http\Controllers;


use App\Exceptions\NotOwningFederationException;
use App\Federation;
use App\Http\Requests\FederationRequest;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class FederationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Federation
     */
    public function index()
    {
        $federations = Federation::with('president', 'country'); // ,'vicepresident','secretary','treasurer','admin'

        $federations = $federations->where('id', '>', 1)->get();
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
     * @param $id
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function edit($id)
    {
        $federation = Federation::findOrFail($id);
        if (Auth::user()->cannot('edit', $federation)) {
            throw new AuthorizationException();
        }

        $users = User::where('country_id', '=', $federation->country_id)->pluck('name', 'id');
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
        try {
            $federation->update($request->all());
            $users = User::where('country_id', '=', $federation->country_id)->pluck('name', 'id');
            $msg = trans('msg.federation_edit_successful', ['name' => $federation->name]);
            flash()->success($msg);

            return redirect(route('federations.index'));

        } catch (QueryException $e) {

            $msg = trans('msg.federation_president_already_exists');
            flash()->error($msg);
            return redirect()->back();

        }
    }
}
