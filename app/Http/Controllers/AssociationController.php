<?php

namespace App\Http\Controllers;

use App\Association;
use App\Federation;
use App\Http\Requests;
use App\Http\Requests\AssociationRequest;
use App\User;
use Illuminate\Http\Request;
use Response;
use View;

class AssociationController extends Controller
{
    // Only Super Admin and Association President can manage Associations

    protected $currentModelName;

    public function __construct()
    {
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
        $associations = Association::with('president','federation.country')->get(); // ,'vicepresident','secretary','treasurer','admin'
        return view('associations.index', compact('associations'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $association = new Association;
        $users = User::where('country_id','=', $association->country_id)->get();
        $federations = Federation::lists('name', 'id');
        $submitButton = trans('core.addModel', ['currentModelName' => $this->currentModelName]);
        return view('associations.form', compact('association','users', 'federations', 'submitButton')); //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AssociationRequest $request
     * @return Response
     */
    public function store(AssociationRequest $request)
    {


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
        $users = User::where('country_id','=', $association->country_id)->get();
        $federations = Federation::lists('name','id');;
        return view('associations.form', compact('association','users','federations'));
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
        $association->update($request->all());
        $msg = trans('msg.association_edit_successful', ['name' => $association->name]);
        flash()->success($msg);
        return redirect("associations");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Association $association
     * @return \Illuminate\Http\Response
     * @throws \Exception
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

}
