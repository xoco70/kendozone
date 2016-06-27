<?php

namespace App\Http\Controllers;

use App\Association;
use App\Exceptions\NotOwningFederationException;
use App\Federation;
use App\Http\Requests;
use App\Http\Requests\AssociationRequest;
use App\Repositories\Eloquent\AssociationRepository;
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
    private $associations;

    /**
     * AssociationController constructor.
     * @param AssociationRepository $associations
     */
    public function __construct(AssociationRepository $associations)
    {

        $this->currentModelName = trans_choice('core.association', 1);
        View::share('currentModelName', $this->currentModelName);

        $this->associations = $associations;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $associations = $this->associations->getAssociationWithPresidentAndCountry()->forUser(Auth::user())->get();
//        $associations = Association::with('president', 'federation.country')->forUser(Auth::user())->get();
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
        $federation = new Collection;

        if (Auth::user()->cannot('create', new Association)) {
            throw new UnauthorizedException();
        }

//        dd(Auth::user()->role);
        $users = User::forUser(Auth::user())->pluck('name', 'id');
        $federations = Federation::forUser(Auth::user())->lists('name', 'id');

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
        $association = $this->associations->create($request->all());
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

        $association = $this->associations->find($id);
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

        $association = $this->associations->find($id);

        $federation = $association->federation;

        if (Auth::user()->cannot('edit', $association)) {
            throw new UnauthorizedException();
        }

        $users = User::forUser(Auth::user())->pluck('name', 'id');
        $federations = Federation::forUser(Auth::user())->lists('name', 'id');

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
        $association = $this->associations->find($id);

        if (Auth::user()->cannot('update', $association)) {
            throw new UnauthorizedException();
        }

        $association->update($request->except(['federation_id']));
        $msg = trans('msg.association_edit_successful', ['name' => $association->name]);
        flash()->success($msg);
        return redirect(URL::action('AssociationController@edit', $association->id));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $associationId
     * @return \Illuminate\Http\Response
     */
    public function destroy($associationId)
    {
        $association = $this->associations->find($associationId);
//        dd($association);
        if ($association->delete()) {
            return Response::json(['msg' => trans('msg.association_delete_successful', ['name' => $association->name]), 'status' => 'success']);
        } else {
            return Response::json(['msg' => trans('msg.association_delete_error', ['name' => $association->name]), 'status' => 'error']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($id)
    {
        $association = $this->associations->findByIdWithTrash($id);
        
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
