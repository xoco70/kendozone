<?php

namespace App\Http\Controllers;

use App\Championship;
use App\Competitor;
use App\Country;
use App\Grade;
use App\Http\Requests\CompetitorRequest;
use App\Invite;
use App\Notifications\InviteCompetitor;
use App\Tournament;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Response;
use URL;

class CompetitorController extends Controller
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
     * @return View
     */
    public function index(Tournament $tournament)
    {
        $tournament = Tournament::with('championships.users', 'championships.teams', 'championships.category')->find($tournament->id);
        $settingSize = $tournament->championshipSettings()->count();
        $categorySize = $tournament->categories->count();
        $grades = Grade::getAllPlucked();
        $countries = Country::getAll();
        $currentModelName = trans_choice('core.competitor', 2) . " - " . trans_choice('core.tournament', 1) . " : " . $tournament->name;
        return view("tournaments.users", compact('tournament', 'currentModelName', 'settingSize', 'categorySize', 'grades', 'countries'));

    }

    /**
     * Show the form for creating a new competitor.
     *
     * @param Request $request
     * @param Tournament $tournament
     * @return View
     */
    public function create(Request $request, Tournament $tournament)
    {
        $championshipId = $request->get('categoryId');
        $currentModelName = trans_choice('core.tournament', 1) . " : " . $tournament->name;

        return view("tournaments/users/create", compact('tournament', 'currentModelName', 'championshipId')); //, compact()
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompetitorRequest $request
     * @param Tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function store(CompetitorRequest $request, Tournament $tournament)
    {

        $championshipId = $request->championshipId;
        $championship = Championship::findOrFail($championshipId);

        foreach ($request->firstnames as $id => $firstname) {
            $email = $request->emails[$id] ?? Auth::user()->id . sha1(rand(1, 999999999999)) . (User::count() + 1) . "@kendozone.com";
            $lastname = $request->lastnames[$id] ?? '';

            $user = Competitor::createUser([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'name' => $firstname . " " . $lastname,
                'email' => $email
            ]);

            $championships = $user->championships();
            // If user has not registered yet this championship
            if (!$championships->get()->contains($championship)) {
                // Get Competitor Short ID
                $categories = $tournament->championships->pluck('id');
                $shortId = Competitor::getShortId($categories, $tournament);
                $championships->attach($championshipId, ['confirmed' => 0, 'short_id' => $shortId]);
            }
            //TODO Should add a test for this
            // We send him an email with detail (and user /password if new)
            if (strpos($email, '@kendozone.com') !== -1) { // It is not a generated email
                $code = resolve(Invite::class)->generateTournamentInvite($user->email, $tournament);
                $user->notify(new InviteCompetitor($user, $tournament, $code, $championship->category->name));
            }
        }
        flash()->success(trans('msg.user_registered_successful', ['tournament' => $tournament->name]));
        return redirect(URL::action('CompetitorController@index', $tournament->slug));


    }

    /**
     * @param $tournamentSlug
     * @param $tcId
     * @param $userSlug
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirmUser($tournamentSlug, $tcId, $userSlug)
    {
        $user = User::where('slug', $userSlug)->first();
        $ctu = Competitor::where('championship_id', $tcId)
            ->where('user_id', $user->id)->first();

        $ctu->confirmed ? $ctu->confirmed = 0 : $ctu->confirmed = 1;
        if ($ctu->save()) {
            return Response::json(['msg' => trans('msg.user_status_successful'), 'status' => 'success']);
        } else {
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

        $user = User::where('slug', $userSlug)->first();
        $ctu = Competitor::where('championship_id', $tcId)
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
     * @return View
     */
    public function show(Tournament $tournament, User $user)
    {
        return view('users.show', compact('tournament', 'user'));
    }
}
