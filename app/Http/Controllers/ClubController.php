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
        $clubs = Club::with('president', 'association.federation')
            ->forUser(Auth::user())
            ->get();

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
        //TODO Set Users to Void and set it with VueJS through APIs
        if (Auth::user()->isFederationPresident()) {

            $federation = Auth::user()->federationOwned;
            $federations->push($federation);

            $federations = $federations->pluck('name', 'id');
            $associations = Auth::user()->federationOwned->associations->pluck('name', 'id');
//            $users = new Collection; // This will be set by JS
            $users = User::where('federation_id', '=', Auth::user()->federationOwned->id)->pluck('name', 'id');

        } else if (Auth::user()->isAssociationPresident()) {


            $federation = Auth::user()->associationOwned->federation;
            $federations->push($federation);
            $federations = $federations->pluck('name', 'id');

            $association = Auth::user()->associationOwned;
            $associations->push($association);
            $associations = $associations->pluck('name', 'id');
            $users = User::where('association_id', '=', Auth::user()->associationOwned->id)->pluck('name', 'id');
        }  else {
            // User is SuperAdmin
            $users = User::pluck('name', 'id');
            $federations = Federation::pluck('name', 'id');
            $associations = Association::pluck('name', 'id');
//            $federations = Federation::pluck('name', 'id');
//            $associations = new Collection; // This will be set by JS
//            $users = new Collection; // This will be set by JS
        }


        return view('clubs.form', compact('club', 'users', 'federations', 'associations')); //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClubRequest $request
     * @return Response
     */
    public function store(ClubRequest $request)
    {

        $club = Club::create($request->except(['federation_id']));
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
        $federations = new Collection();
        $associations = new Collection();

        if (Auth::user()->cannot('edit', $club)) {
            throw new UnauthorizedException();
        }

        //TODO Set Users to Void and set it with VueJS through APIs
        if (Auth::user()->isFederationPresident()) {

            $federation = Auth::user()->federationOwned;
            $federations->push($federation);
            $federations = $federations->pluck('name', 'id');

            $associations = Auth::user()->federationOwned->associations->pluck('name', 'id');
//            $users = new Collection; // This will be set by JS
            $users = User::where('federation_id', '=', Auth::user()->federationOwned->id)->pluck('name', 'id');

        } else if (Auth::user()->isAssociationPresident()) {
            $federation = Auth::user()->associationOwned->federation;
            $federations->push($federation);

            $federations = $federations->pluck('name', 'id');

            $association = Auth::user()->associationOwned;
            $associations->push($association);
            $associations = $associations->pluck('name', 'id');
            $users = User::where('association_id', '=', Auth::user()->associationOwned->id)->pluck('name', 'id');
        } else if (Auth::user()->isClubPresident()) {
            $federation = Auth::user()->clubOwned->association->federation;
            $federations->push($federation);

            $federations = $federations->pluck('name', 'id');

            $association = Auth::user()->clubOwned->association;
            $associations->push($association);
            $associations = $associations->pluck('name', 'id');
            $users = User::where('club_id', '=', Auth::user()->clubOwned->id)->pluck('name', 'id');
        }
        else {
            // User is SuperAdmin
            $users = User::pluck('name', 'id');
            $federations = Federation::pluck('name', 'id');
            $associations = Association::pluck('name', 'id');
//            $federations = Federation::pluck('name', 'id');
//            $associations = new Collection; // This will be set by JS
//            $users = new Collection; // This will be set by JS
        }

        return view('clubs.form', compact('club', 'users', 'associations', 'federations')); //
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

        if (Auth::user()->cannot('update', $club)) {
            throw new UnauthorizedException();
        }

        $club->update($request->except(['federation_id']));
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
