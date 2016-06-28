<?php

namespace App\Http\Controllers;


use App\Exceptions\NotOwningFederationException;
use App\Federation;
use App\Http\Requests;
use App\Http\Requests\FederationRequest;
use App\Repositories\Eloquent\FederationRepository;
use App\Repositories\Eloquent\UserRepository;
use App\User;
use Illuminate\Contracts\Validation\UnauthorizedException;
use Illuminate\Support\Facades\Auth;
use Request;
use URL;

class FederationController extends Controller
{

    private $users, $federations;

    /**
     * FederationController constructor.
     * @param UserRepository $users
     * @param FederationRepository $federations
     */
    public function __construct(UserRepository $users, FederationRepository $federations)
    {
        $this->users = $users;
        $this->federations = $federations;
    }

    // Only Super Admin can manage Federations

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $federations = $this->federations->getFederationWithPresidentAndCountry(); // ,'vicepresident','secretary','treasurer','admin'

        if (Request::ajax()) {
            return $federations->orderBy('id', 'asc')-> get(['id as value', 'name as text'])->toArray();
        } else {
            $federations = $federations->get();
            return view('federations.index', compact('federations'));
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $federation = $this->federations->find($id);
        return view('federations.show', compact('federation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $federation = $this->federations->find($id);
        if (Auth::user()->cannot('edit', $federation)) {
            throw new UnauthorizedException();
        }

        $users = $this->users->findByField('country_id', $federation->country_id)->pluck('name', 'id');
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
        $federation = $this->federations->find($id);
        if (Auth::user()->cannot('update', $federation)) {
            throw new NotOwningFederationException();
        }
        $federation->update($request->all());
        $users = $this->users->findByField('country_id', $federation->country_id)->lists('name', 'id');
        $msg = trans('msg.federation_edit_successful', ['name' => $federation->name]);
        flash()->success($msg);

        return redirect(URL::action('FederationController@edit', $federation->id))->with('users');
    }

}
