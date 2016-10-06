<?php

namespace App\Http\Controllers;

use App\Association;
use App\Club;
use App\Federation;
use App\Http\Requests\ClubRequest;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Response;

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
     * @return Association | View
     */
    public function index()
    {
        if (Request::ajax()) {
            return Association::fillSelect();
        } else {
            $clubs = Club::with('president', 'association.federation')
                ->forUser(Auth::user())
                ->where('id', '>', 1)
                ->get();

            return view('clubs.index', compact('clubs'));
        }

    }


    /**
     * Show the form for creating a new resource.
     * @return View
     * @throws AuthorizationException
     */
    public function create()
    {
        $club = new Club;
        if (Auth::user()->cannot('create', $club)) {
            throw new AuthorizationException();
        }

        $federations = Federation::fillSelect();
        $associations = Association::fillSelect();
        $users = User::fillSelect();

        $defaultLng = Auth::user()->latitude ?? geoip()->lat;
        $defaultLat = Auth::user()->longitude ?? geoip()->lon;


        return view('clubs.form', compact('club', 'users', 'federations', 'associations','defaultLng','defaultLat')); //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClubRequest $request
     * @return Response
     */
    public function store(ClubRequest $request)
    {
        try {
            $club = Club::create($request->except(['federation_id']));
            $msg = trans('msg.club_edit_successful', ['name' => $club->name]);
            flash()->success($msg);
            return redirect("clubs");
        } catch (QueryException $e) {
            $user = User::find($request->president_id);
            $msg = trans('msg.club_president_already_exists',['user' => $user->name] );
            flash()->error($msg);
            return redirect()->back();
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return View
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
     * @return View
     * @throws AuthorizationException
     */
    public function edit($id)
    {
        $club = Club::findOrFail($id);
        if (Auth::user()->cannot('edit', $club)) {
            throw new AuthorizationException();
        }

        $federations = Federation::fillSelect();
        $associations = Association::fillSelect();
        $users = User::getClubPresidentsList();


        return view('clubs.form', compact('club', 'users', 'associations', 'federations')); //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClubRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function update(ClubRequest $request, $id)
    {
        $club = Club::findOrFail($id);

        if (Auth::user()->cannot('update', $club)) {
            throw new AuthorizationException();
        }
        try {
            $club->update($request->except(['federation_id']));
            $msg = trans('msg.club_edit_successful', ['name' => $club->name]);
            flash()->success($msg);
            return redirect("clubs");
        } catch (QueryException $e) {
            // Already
            $msg = "User" . $request->id . "is already president of another club";
            flash()->error($msg);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $clubId
     * @return JsonResponse
     * @internal param Club $club
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
     * @param $id
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

    public static function myClubs()
    {
        return Club::fillSelect();
    }


}
