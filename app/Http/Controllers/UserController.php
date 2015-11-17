<?php

namespace App\Http\Controllers;


use App\Grade;
use App\Role;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Webpatser\Countries\Countries;

class UserController extends Controller
{
    protected $currentModelName;

    public function __construct()
    {
//        $this->middleware('auth');
        // Fetch the Site Settings object
        $this->currentModelName = Lang::get('crud.user');
        View::share('currentModelName', $this->currentModelName);

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = DB::table('users')
            ->leftJoin('countries', 'users.countryId', '=', 'countries.id')
            ->select('users.*', 'countries.name as country', 'countries.flag')
            ->get();

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
        $countries = Countries::lists('name', 'id');

        return view('users.create', compact('user', 'countries', 'grades','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if (Input::file('picture')!=null && Input::file('picture')->isValid()) {
            $destinationPath = Config::get('constants.AVATAR_PATH');
            $extension = Input::file('picture')->getClientOriginalExtension(); // getting image extension
            $date = new DateTime();
            $timestamp =  $date->getTimestamp();
            $fileName = $timestamp.'.'.$extension; // renameing image
            Input::file('picture')->move($destinationPath, $fileName); // uploading file to given path
        }

        if (User::create($request->all())) {
            Session::flash('flash_message', 'Operación Exitosa!');
        } else
            Session::flash('flash_message', 'Operación No realizada!');
        return redirect('users');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show($user)
    {
        $user->delete();
        return redirect("users");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit(User $user)
    {
        $roles = Role::lists('name', 'id');
        $grades = Grade::lists('name', 'id');
        $countries = Countries::lists('name', 'id');

        return view('users.edit', compact('user', 'countries', 'grades','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $profile
     * @return Response
     */
    public function update(Request $request, User $user)
    {
        if (Input::file('picture')->isValid()) {
            $destinationPath = Config::get('constants.AVATAR_PATH');
            $extension = Input::file('picture')->getClientOriginalExtension(); // getting image extension
            $date = new DateTime();
            $timestamp =  $date->getTimestamp();
            $fileName = $timestamp.'.'.$extension; // renameing image
            Input::file('picture')->move($destinationPath, $fileName); // uploading file to given path
        }

        $user->update($request->all());

        return redirect("users");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function showProfile(User $user)
    {
        $grades = Grade::lists('name', 'id');
        $countries = Countries::lists('name', 'id');
        return view('users.show', compact('user', 'countries', 'grades'));
    }
}
