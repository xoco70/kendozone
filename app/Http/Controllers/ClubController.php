<?php

namespace App\Http\Controllers;

use App\Association;
use App\Club;
use App\Federation;
use App\Http\Requests;
use App\Http\Requests\ClubRequest;
use App\User;
use Auth;
use Illuminate\Contracts\Validation\UnauthorizedException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Response;
use View;

class ClubController extends Controller
{
    // Only Super Admin and Club President can manage Clubs

    protected $currentModelName;

    public function __construct()
    {
        $this->currentModelName = trans_choice('core.club', 1);
        View::share('currentModelName', $this->currentModelName);


    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubs = Club::with('president', 'association.federation');

        if (Auth::user()->isAssociationPresident()) {
            $clubs->whereHas('association', function ($query) {
                $query->where('id', Auth::user()->associationOwned->id);
            });
        }
        if (Auth::user()->isFederationPresident()) {
            $clubs->whereHas('association.federation', function ($query) {
                $query->where('federation_id', Auth::user()->federationOwned->id);
            });
        }


        $clubs = $clubs->get();

//        dd($clubs);
        return view('clubs.index', compact('clubs'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $club = new Club;
        $federations = new Collection();
        $associations = new Collection();
        if (Auth::user()->cannot('create', $club)) {
            throw new UnauthorizedException();
        }

        if (Auth::user()->isFederationPresident()) {

            $federation = Auth::user()->federationOwned;
            $federations->push($federation);

            $federations = $federations->pluck('name', 'id');
            $associations = Auth::user()->federationOwned->associations->pluck('name', 'id');
            $users = new Collection; // This will be set by JS

        } else if (Auth::user()->isAssociationPresident()) {


            $federation = Auth::user()->associationOwned->federation;
            $federations->push($federation);
            $federations = $federations->pluck('name', 'id');

            $association = Auth::user()->associationOwned;
            $associations->push($association);
            $associations = $associations->pluck('name', 'id');
            // NO REGRESA USUARIOS PARA EDOMEX, INVESTIGAR
            $users = User::where('association_id', '=', Auth::user()->associationOwned->id)->pluck('name', 'id');
        } else {
            // User is SuperAdmin
            $federations = Federation::pluck('name', 'id');
            $associations = new Collection; // This will be set by JS
            $users = new Collection; // This will be set by JS
        }


        $submitButton = trans('core.addModel', ['currentModelName' => $this->currentModelName]);
        return view('clubs.form', compact('club', 'users', 'federations', 'associations', 'submitButton')); //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClubRequest $request
     * @return Response
     */
    public function store(ClubRequest $request)
    {


        $club = Club::create($request->all());
        $msg = trans('msg.club_edit_successful', ['name' => $club->name]);
        flash()->success($msg);
        return redirect("clubs");
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $club = Club::findOrFail($id);
        return view('clubs.show', compact('club'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $club = Club::findOrFail($id);
        $users = User::lists('name', 'id');; // TODO BADDDDD
        $associations = Association::lists('name', 'id');
        return view('clubs.form', compact('club', 'users', 'associations')); //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClubRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClubRequest $request, $id)
    {

        $club = Club::findOrFail($id);
        $club->update($request->all());
        $msg = trans('msg.club_edit_successful', ['name' => $club->name]);
        flash()->success($msg);
        return redirect("clubs");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Club $club
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($clubId)
    {
        $club = Club::find($clubId);
//        dd($club);
        if ($club->delete()) {
            return Response::json(['msg' => trans('msg.club_delete_successful', ['name' => $club->name]), 'status' => 'success']);
        } else {
            return Response::json(['msg' => trans('msg.club_delete_error', ['name' => $club->name]), 'status' => 'error']);
        }
    }

    /**
     * @param $tournamentSlug
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($id)

    {
        $club = Club::withTrashed()->find($id);
        if ($club->restore()) {
            return Response::json(['msg' => trans('msg.club_restored_successful', ['name' => $club->name]), 'status' => 'success']);
        } else {
            return Response::json(['msg' => trans('msg.club_restored_error', ['name' => $club->name]), 'status' => 'error']);
        }
    }

}
