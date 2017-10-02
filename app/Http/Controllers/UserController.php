<?php

namespace App\Http\Controllers;


use App\Association;
use App\Club;
use App\Country;
use App\Federation;
use App\Grade;
use App\Http\Requests\UserRequest;
use App\Notifications\AccountCreated;
use App\Role;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use URL;

class UserController extends Controller
{
    protected $currentModelName;

    public function __construct()
    {
        // Fetch the Site Settings object
        $this->currentModelName = trans_choice('core.user', 1);
        View::share('currentModelName', $this->currentModelName);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $users = User::with('country', 'role', 'association', 'federation')
            ->forUser(Auth::user())
            ->where('id', '>', 1)
            ->paginate(config('constants.PAGINATION'));

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return View
     * @throws AuthorizationException
     */
    public function create()
    {
        $user = new User();
        if (Auth::user()->cannot('create', $user)) {
            throw new AuthorizationException();
        }

        $roles = Role::grantedRoles(Auth::user()->role_id)->pluck('name', 'id');
        $grades = Grade::getAllPlucked();
        $countries = Country::getAllPlucked();
        $submitButton = trans('core.addModel', ['currentModelName' => $this->currentModelName]);
        $federations = Federation::fillSelect();
        $associations = Association::fillSelect();
        $clubs = Club::fillSelect(Auth::user()->federation_id,Auth::user()->association_id);
        return view('users.form', compact('user', 'grades', 'countries', 'roles', 'submitButton', 'federations', 'associations', 'clubs')); //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $userForm
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function store(UserRequest $userForm)
    {
        try {
            $userForm->store();
            $user = User::where('email', $userForm->email)->first();
            $user->notify(new AccountCreated($user));
            flash()->success(trans('msg.user_create_successful'));
        } catch (QueryException $e) {
            flash()->error(trans('msg.user_already_exists'));
            return redirect()->back()->withInput();
        }
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function show(User $user)
    {


        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return View
     * @throws AuthorizationException
     */
    public function edit(User $user)
    {
        if (Auth::user()->cannot('edit', $user)) {
            throw new AuthorizationException();
        }
        $roles = Role::grantedRoles(Auth::user()->role_id)->pluck('name', 'id');
        $grades = Grade::orderBy('order')->pluck('name', 'id');
        $countries = Country::pluck('name', 'id');
        $federations = Federation::fillSelect();
        $associations = Association::fillSelect();

        $clubs = Club::fillSelect(Auth::user()->federation_id,Auth::user()->association_id);

        return view('users.form', compact('user', 'grades', 'countries', 'roles', 'federations', 'associations', 'clubs')); //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest $userForm
     * @param User $user
     * @return Response
     */
    public function update(UserRequest $userForm, User $user)
    {
        if ($userForm->update($user)) {
            flash()->success(trans('msg.user_update_successful'));
        } else
            flash()->error(Lang::get('msg.user_update_error'));

        if ($user->id == Auth::user()->id){
            return redirect(URL::action('UserController@edit', Auth::user()->slug));
        }

        return redirect(route('users.index'));

    }


    public function export()
    {

        Excel::create(trans_choice('core.user', 2), function ($excel) {
            $appName = (app()->environment() == 'local' ? getenv('APP_NAME') : config('app.name'));

            // Set the title
            $excel->setTitle(trans_choice('core.user', 2));

            // Chain the setters
            $excel->setCreator($appName)
                ->setCompany($appName);

            // Call them separately
            $excel->setDescription('A list of users');
            $excel->sheet(trans_choice('core.user', 2), function ($sheet) {
                //TODO Here we should join grade, role, country to print name not FK
                $users = User::all();
//                $users = User::with(['grade', 'role'])->get();
                $sheet->fromArray($users);
            });


        })->export('xls');
    }

    public function getMyTournaments(Request $request)
    {
        $tournaments = Auth::user()->myTournaments()->with('owner')
            ->orderBy('created_at', 'desc')
            ->paginate(config('constants.PAGINATION'));;

        $title = trans('core.tournaments_registered');

        return view('users.tournaments', compact('tournaments', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {

        if ($user->delete()) {
            return Response::json(['msg' => trans('msg.user_delete_successful'), 'status' => 'success']);
        }
        return Response::json(['msg' => trans('msg.user_delete_error'), 'status' => 'error']);

    }

    /**
     * @param $userSlug
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($userSlug)

    {
        $user = User::withTrashed()->whereSlug($userSlug)->first();
        if ($user->restore()) {
            return Response::json(['msg' => trans('msg.user_restore_successful'), 'status' => 'success']);
        }
        return Response::json(['msg' => trans('msg.user_restore_successful'), 'status' => 'error']);

    }

    public function myFederations(User $user)
    {
        return Federation::fillSelectForVueJs($user);
    }

    public function myAssociations(User $user, $federationId)
    {
        return Association::fillSelectForVuejs($user, $federationId);
    }

    public function myClubs(User $user, $federationId, $associationId)
    {
        return Club::fillSelectForVueJs($user, $federationId, $associationId);
    }

}
