<?php

namespace App\Http\Controllers;


use App\Grade;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use Response;
use Webpatser\Countries\Countries;

class UserController extends Controller
{
    protected $currentModelName;

    public function __construct()
    {
//        $this->middleware('auth');
        // Fetch the Site Settings object
        $this->currentModelName = trans_choice('core.user', 1);
        $this->modelPlural = trans_choice('core.user', 1);
        View::share('currentModelName', $this->currentModelName);
        View::share('modelPlural', $this->modelPlural);


    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (Auth::user()->isSuperAdmin()) {
            $users = User::paginate(Config::get('constants.PAGINATION'));

            return view('users.index', compact('users'));
        } else {
            return view('errors.general',
                ['code' => '403',
                    'message' => trans('core.forbidden'),
                    'quote' => trans('msg.access_denied'),
                    'author' => 'Admin',
                    'source' => '',
                ]
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $user = new User();
        $roles = Role::lists('name', 'id');
        $grades = Grade::lists('name', 'id');
        $countries = Countries::lists('name', 'id');
        $submitButton = trans('core.addModel', ['currentModelName' => $this->currentModelName]);
        return view('users.form', compact('user', 'grades', 'countries', 'roles', 'submitButton')); //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->except('_token');

        if ($request->is("users")) {
            $data['provider'] = "created";
        } else {
            $data['provider'] = "register";
        }

        $data['provider_id'] = $data['email'];
        $data['verified'] = 1;

        if (User::create($data)) {
            flash()->success(Lang::get('core.success'));
        } else
            flash()->error(Lang::get('core.fail'));
        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show($user)
    {

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit(User $user)
    {
        $roles = Role::lists('name', 'id');
        $grades = Grade::orderBy('order')->lists('name', 'id');
        $countries = Countries::lists('name', 'id');

        return view('users.edit', compact('user', 'grades', 'countries', 'roles')); //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest $request
     * @param User $user
     * @return Response
     */
    public function update(UserRequest $request, User $user)
    {
//        dd($request);
        $except = [];
        if (trim(Input::get('role_id')) == '') {
            array_push($except, 'role_id');
        }
        if (trim(Input::get('password')) == '' && trim(Input::get('password_confirmation')) == '') {
            array_push($except, 'password');

        }

//        if (trim(Input::get('avatar')) == '') {
//            array_push($except, 'avatar');
//        }
        array_push($except, '_token');

        $req = $request->except($except);
//        $data = User::uploadPic($req);


        //TODO: Should have an expection for pics


        if ($user->update($req)) {
            flash()->success(trans('msg.user_update_successful', ['name' => $user->name]));
        } else
            flash()->success(Lang::get('msg.user_update_error'));


        if ($user->id == Auth::user()->id) {
            return redirect("/users/" . Auth::user()->slug . "/edit");
        } else  {
            return redirect("/users/");
        }

    }


    public function exportUsersExcel()
    {

        Excel::create(trans_choice('core.user', 2), function ($excel) {
            $appName = (app()->environment()=='local' ? getenv('APP_NAME') : config('app.name'));

            // Set the title
            $excel->setTitle(trans_choice('core.user', 2));

            // Chain the setters
            $excel->setCreator($appName)
                ->setCompany($appName);

            // Call them separately
            $excel->setDescription('A list of users');
            $excel->sheet(trans_choice('core.user', 2), function ($sheet) {
                $users = User::all();
                $sheet->fromArray($users);
            });


        })->export('xls');
    }
    public function getMyTournaments(Request $request)
    {
        $tournaments = Auth::user()->myTournaments()
            ->orderBy('created_at', 'desc')
            ->paginate(Config::get('constants.PAGINATION'));;

        $title = trans('core.tournaments_registered');
        
        return view('users.tournaments', compact('tournaments','title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     * @throws \Exception
     * @internal param int $id
     */
    public function destroy(User $user)
    {

        if ($user->delete()) {
            return Response::json(['msg' => trans('msg.user_delete_successful',['name' => $user->name]), 'status' => 'success']);
        } else {
            return Response::json(['msg' => trans('msg.user_delete_error',['name' => $user->name]), 'status' => 'error']);
        }
    }

    public function restore($userSlug)

    {
        $user = User::withTrashed()->whereSlug($userSlug)->first();
        if ($user->restore()) {
            return Response::json(['msg' => trans('msg.user_restore_successful',['name' => $user->name]), 'status' => 'success']);
        } else {
            return Response::json(['msg' => trans('msg.user_restore_successful',['name' => $user->name]), 'status' => 'error']);
        }
    }


    public function uploadAvatar(Request $request){
        $data = $request->except('_token');
        $data = User::uploadPic($data);
        return $data;

    }

}
