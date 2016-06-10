<?php

namespace App\Http\Controllers;

use App\Association;
use App\Exceptions\NotOwningFederationException;
use App\Federation;
use App\Http\Requests;
use App\Http\Requests\AssociationRequest;
use App\User;
use Illuminate\Contracts\Validation\UnauthorizedException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Response;
use URL;
use View;

class AssociationController extends Controller
{
    // Only Super Admin and Association President can manage Associations

    protected $currentModelName;

    public function __construct()
    {
//        $this->middleware('association', ['except' => ['index','show']]); //
        $this->currentModelName = trans_choice('core.association', 1);
        View::share('currentModelName', $this->currentModelName);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO Will fail if Auth::user()->associationOwned->federation is null

        // 2 Cases, if root, show everything, else show only for your country
        $associations = Association::with('president', 'federation.country')
            ->whereHas('federation', function ($query) {
                if (!Auth::user()->isSuperAdmin()) {
                    $query->where('country_id', Auth::user()->country_id);
                }
            })->get();


        return view('associations.index', compact('associations'));
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     * @throws NotOwningFederationException
     */
    public function create()
    {
        $association = new Association;
        $federations = new Collection;
        $federation = new Federation;

        if (Auth::user()->cannot('create', new Association)) {
            throw new UnauthorizedException();
        }

        if (Auth::user()->isFederationPresident()) {
            $users = User::where('country_id', '=', $federation->country_id)->lists('name', 'id'); //TODO Should be list of user which belongs to association
        } else {
            // User is SuperAdmin
            $users = User::lists('name', 'id'); //TODO Should be list of user which belongs to association
            $federations = Federation::lists('name', 'id');
        }


        $submitButton = trans('core.addModel', ['currentModelName' => $this->currentModelName]);
        return view('associations.form', compact('association', 'users', 'federation', 'federations', 'submitButton')); //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AssociationRequest $request
     * @return Response
     */
    public function store(AssociationRequest $request)
    {
        // Assoc Policy
        if (!Auth::user()->isSuperAdmin() && !Auth::user()->isFederationPresident()) {
            throw new UnauthorizedException();
        }

        $association = Association::create($request->all());
        $msg = trans('msg.association_edit_successful', ['name' => $association->name]);
        flash()->success($msg);
        return redirect("associations");
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

        if (Auth::user()->cannot('edit', $association)) {
            throw new UnauthorizedException();
        }

        $users = User::where('country_id', '=', $association->federation->country_id)->lists('name', 'id');
        $federations = Federation::lists('name', 'id');
        $federation = $association->federation;
        return view('associations.form', compact('association', 'users', 'federations', 'federation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AssociationRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AssociationRequest $request, $id)
    {
        $association = Association::findOrFail($id);

        if (Auth::user()->cannot('update', $association)) {
            throw new UnauthorizedException();
        }

        $association->update($request->all());
        $msg = trans('msg.association_edit_successful', ['name' => $association->name]);
        flash()->success($msg);
        return redirect(URL::action('AssociationController@edit', $association->id));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $associationId
     * @return \Illuminate\Http\Response
     * @internal param Association $association
     */
    public function destroy($associationId)
    {
        $association = Association::find($associationId);
//        dd($association);
        if ($association->delete()) {
            return Response::json(['msg' => trans('msg.association_delete_successful', ['name' => $association->name]), 'status' => 'success']);
        } else {
            return Response::json(['msg' => trans('msg.association_delete_error', ['name' => $association->name]), 'status' => 'error']);
        }
    }

    /**
     * @param $tournamentSlug
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($id)

    {
        $association = Association::withTrashed()->find($id);
        if ($association->restore()) {
            return Response::json(['msg' => trans('msg.association_restored_successful', ['name' => $association->name]), 'status' => 'success']);
        } else {
            return Response::json(['msg' => trans('msg.association_restored_error', ['name' => $association->name]), 'status' => 'error']);
        }
    }


    public function changePresident()
    {
        // Open Transaction
        // Get the current president
        // Set the new president
        // Save
        // Close transaction
    }

}
