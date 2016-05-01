<?php

namespace App\Http\Controllers;

use App\CategoryTournament;
use App\CategoryTournamentUser;
use App\Grade;
use App\Http\Requests;
use App\Http\Requests\TournamentUserRequest;
use App\Invite;
use App\Mailers\AppMailer;
use App\Tournament;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Response;
use URL;

class TournamentUserController extends Controller
{
    protected $currentModelName;

    public function __construct()
    {
        $this->currentModelName = trans_choice('core.tournament', 2);
        View::share('currentModelName', $this->currentModelName);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function index(Tournament $tournament)
    {
        $tournament = Tournament::with('categoryTournaments.users', 'categoryTournaments.category')->find($tournament->id);
        $settingSize = $tournament->settings()->count();
        $categorySize = $tournament->categories->count();
        $grades = Grade::lists('name','id');

        $currentModelName = trans_choice('core.competitor', 2) . " - " . trans_choice('core.tournament', 1) . " : " . $tournament->name;
        return view("tournaments/users", compact('tournament', 'currentModelName', 'settingSize', 'categorySize','grades'));

    }

    /**
     * Show the form for creating a new competitor.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Tournament $tournament)
    {
        $categoryTournamentId = $request->get('categoryId');
        $currentModelName = trans_choice('core.tournament', 1) . " : " . $tournament->name;

        return view("tournaments/users/create", compact('tournament', 'currentModelName', 'categoryTournamentId')); //, compact()
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Tournament $tournament
     * @param AppMailer $mailer
     * @return \Illuminate\Http\Response
     */
    public function store(TournamentUserRequest $request, Tournament $tournament, AppMailer $mailer)
    {
        $categoryTournamentId = $request->categoryTournamentId;
        
        $categoryTournament = CategoryTournament::findOrFail($categoryTournamentId);

        
        $user = User::registerUserToTournament([
            'name' => $request->username,
            'email' => $request->email

        ]);

        $ctu = $user->categoryTournaments();

        if ($ctu->get()->contains($categoryTournament)) {
            flash()->error(trans('msg.user_already_registered_in_category'));
            return redirect(URL::action('TournamentUserController@index', $tournament->slug));
        } else {
            $ctu->attach($categoryTournamentId, ['confirmed' => 0]);
        }


        // We send him an email with detail (and user /password if new)
        $invite = new Invite();
        $code = $invite->generate($user->email, $tournament);
        $mailer->sendEmailInvitationTo($user->email, $tournament, $code, $categoryTournament->category->name, $user->clearPassword);

//        return Response::json(['msg' => trans('msg.user_registered_successful', ['name' => $tournament->name]), 'status' => 'success']);
        flash()->success(trans('msg.user_registered_successful',['tournament' => $tournament->name]));
        return redirect(URL::action('TournamentUserController@index', $tournament->slug));


    }

    /**
     * @param $tournamentSlug
     * @param $tcId
     * @param $userSlug
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirmUser($tournamentSlug, $tcId, $userSlug)
    {
        $user = User::findBySlug($userSlug);
        $ctu = CategoryTournamentUser::where('category_tournament_id', $tcId)
            ->where('user_id', $user->id)->first();

        $ctu->confirmed ? $ctu->confirmed = 0 : $ctu->confirmed = 1;
        if ($ctu->save()){
            return Response::json(['msg' => trans('msg.user_status_successful'), 'status' => 'success']);
        }else{
            return Response::json(['msg' => trans('msg.user_status_error'), 'status' => 'error']);
        }

    }

    /**
     * @param $tournamentSlug
     * @param $tcId
     * @param $userSlug
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteUser($tournamentSlug, $tcId, $userSlug)
    {

        $user = User::findBySlug($userSlug);
        $ctu = CategoryTournamentUser::where('category_tournament_id', $tcId)
            ->where('user_id', $user->id);

        if ($ctu->forceDelete()) {
            return Response::json(['msg' => trans('msg.user_delete_successful'), 'status' => 'success']);
        } else {
            return Response::json(['msg' => trans('msg.user_delete_error'), 'status' => 'error']);
        }
//        flash()->success(trans('core.operation_successful'));
//        return redirect("tournaments/$tournamentSlug/users");

    }


    /**
     * Display the specified resource.
     *
     * @param Tournament $tournament
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(Tournament $tournament, User $user)
    {
        return view('users.show', compact('tournament', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tournament $tournament
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournament $tournament, User $user)
    {

        $user = User::with('categorytournaments.tournament', 'categoryTournaments.category')->find($user->id);
        dd($user->categoryTournaments);
        $currentModelName = trans_choice('core.tournament', 1) . " : " . $tournament->name;
        return view("tournaments/users/edit", compact('tournament', 'currentModelName', 'user')); //, compact()

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
//    public function update(Request $request, $tournamentId, $user)
//    {
////TODO Se podria usar eloquent mas facil - ya no me acuerdo donde se usa
//        $this->validate($request, [
//            'cat' => 'required|array'
//
//        ]);
//
//        $tcat = $request->cat;
//
//        // We add him to the different categor
//        $tcusToCreate = array();
//        $categories = array();
//        foreach ($tcat as $tCategoryId) {
//            array_push($tcusToCreate, ['category_tournament_id' => $tCategoryId,
//                'user_id' => $user->id]);
//
//            array_push($categories, trans(CategoryTournament::findOrFail($tCategoryId)->category->name));
//        }
//
//        // Get all TournamentCategories Related to this tournament
//        // We can't just delete and create rows, because id is changing. We must delete and update existing
//        // Making diff between old and new
//
//        $categoriesTournement = CategoryTournament::where('tournament_id', $tournamentId)->lists('id');
//
//        // Delete All Registered category
//        CategoryTournamentUser::whereIn('category_tournament_id', $categoriesTournement)
//            ->where('user_id', $user->id)
//            ->delete();
//
//
//        CategoryTournamentUser::insert($tcusToCreate);
//        // We send him an email with detail ( and user /password if new)
////        $invite = new Invite();
////        $code = $invite->generate($user->email, $tournament);
////        $mailer->sendEmailInvitationTo($user->email, $tournament, $code, $categories, $password);
//
//        flash()->success(trans('msg.operation_successful'));
//        return redirect(URL::action('TournamentUserController@index', $tournament->slug));
//    }


}
