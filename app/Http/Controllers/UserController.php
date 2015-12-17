<?php

namespace App\Http\Controllers;


use App\Grade;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use Webpatser\Countries\Countries;

class UserController extends Controller
{
    protected $currentModelName;

    public function __construct()
    {
//        $this->middleware('auth');
        // Fetch the Site Settings object
        $this->currentModelName = trans_choice('crud.user', 1);
        $this->modelPlural = trans_choice('crud.user', 1);
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

        $users = User::paginate(Config::get('constants.PAGINATION'));

        return view('users.index', compact('users'));
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
//        $countries = Countries::lists('name', 'id');

        return view('users.create', compact('user', 'grades', 'roles')); // 'countries',
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(UserRequest $request)
    {

        $data = User::uploadPic($request,null);
//        dd(Input::file('avatar'), $destinationPath, $fileName,Input::file('avatar')->move($destinationPath, $fileName));
        if ($request->is("users")) {
            $data['provider'] = "created";
        } else {
            $data['provider'] = "register";
        }

        $data['provider_id'] = $data['email'];
        $data['verified'] = 1;
//        dd($data);
//        $user =
//        $user->avatar = $fileName;

        if (User::create($data)) {
            flash('success', Lang::get('core.success'));
        } else
            flash('error', Lang::get('core.fail'));
        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public
    function show($user)
    {
//        $user->delete();
        flash("info", "not implemented yet");
        return redirect("users");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit(User $user)
    {
//        $user = User::findOrFail($id);
        $roles = Role::lists('name', 'id');
        $grades = Grade::orderBy('order')->lists('name', 'id');
//        $countries = Countries::lists('name', 'id');

        return view('users.edit', compact('user',  'grades', 'roles')); // 'countries',
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $profile
     * @return Response
     */
    public function update(UserRequest $request, User $user)
    {
        $except = [];
        if (trim(Input::get('role_id')) == '') {
            array_push($except, 'role_id');
        }
        if (trim(Input::get('password')) == '' && trim(Input::get('password_confirmation')) == '') {
            array_push($except, 'password');

        }
        $data = User::uploadPic($request, $except);

        if ($user->update($data)) {
            flash('success', Lang::get('core.success'));
        } else
            flash('error', Lang::get('core.fail'));


        return redirect("/users");
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
//    public function showProfile($id)
//    {
//        $user = User::findOrFail($id);
//        $grades = Grade::lists('name', 'id');
//        $countries = Countries::lists('name', 'id');
//        return view('users.show', compact('user', 'countries', 'grades'));
//    }

    public function exportExcel(Request $request){
        Excel::create('Filename', function($excel) {

            // Set the title
            $excel->setTitle('Our new awesome title');

            // Chain the setters
            $excel->setCreator('Maatwebsite')
                ->setCompany('Maatwebsite');

            // Call them separately
            $excel->setDescription('A demonstration to change the file properties');

        })->export('xls')
        ;
    }
}
