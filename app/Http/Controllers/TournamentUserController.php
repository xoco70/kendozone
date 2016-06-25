<?php

namespace App\Http\Controllers;

use App\CategoryTournament;
use App\CategoryTournamentUser;
use App\Grade;
use App\Http\Requests;
use App\Http\Requests\TournamentUserRequest;
use App\Invite;
use App\Mailers\AppMailer;
use App\Repositories\Eloquent\UserRepository;
use App\Tournament;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Response;
use URL;

class TournamentUserController extends Controller
{
    protected $currentModelName;
    private $users;
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
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
     * @param Request $request
     * @param Tournament $tournament
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

        $user = $this->users->registerUserToCategory([
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
        $code = $invite->generateTournamentInvite($user->email, $tournament);
        $mailer->sendEmailInvitationTo($user->email, $tournament, $code, $categoryTournament->category->name, $user->clearPassword);

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
        $user = $this->users->findBySlug($userSlug);
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

        $user = $this->users->findBySlug($userSlug);
        $ctu = CategoryTournamentUser::where('category_tournament_id', $tcId)
            ->where('user_id', $user->id);

        if ($ctu->forceDelete()) {
            return Response::json(['msg' => trans('msg.user_delete_successful'), 'status' => 'success']);
        } else {
            return Response::json(['msg' => trans('msg.user_delete_error'), 'status' => 'error']);
        }
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
}
