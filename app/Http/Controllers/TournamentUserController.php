<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\TournamentRequest;
use App\Invite;
use App\Mailers\AppMailer;
use App\Tournament;
use App\TournamentCategory;
use App\TournamentCategoryUser;
use App\User;
use GeoIP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Webpatser\Countries\Countries;

//use App\Place;

class TournamentUserController extends Controller
{
    protected $currentModelName;

    public function __construct()
    {
        $this->currentModelName = trans_choice('crud.tournament', 2);
        View::share('currentModelName', $this->currentModelName);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tournamentId)
    {
        $tournament = Tournament::find($tournamentId)->first();
        $currentModelName = trans_choice('crud.competitor', 2) . " - " . trans_choice('crud.tournament', 1) . " : " . $tournament->name;
        $users = $tournament->competitors();


        return view("tournaments/users", compact('users', 'currentModelName'));

    }

    /**
     * Show the form for creating a new competitor.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Tournament $tournament)
    {
        $currentModelName = trans_choice('crud.tournament', 1) . " : " . $tournament->name;
        return view("tournaments/create_user", compact('tournament', 'currentModelName')); //, compact()
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $tournamentId, AppMailer $mailer)
    {
        $this->validate($request, [
            'username' => 'required|max:255',
            'email' => 'required',
            'cat' => 'required|array'

        ]);

        $tcat = $request->cat;
        $email = $request->email;
        $username = $request->username;

        $tournament = Tournament::findOrFail($tournamentId);
        $user = User::where('email', $email)->first();
        $password = null;
        if (is_null($user)) {
            //Create user first
            $location = GeoIP::getLocation("189.209.75.100"); // Simulating IP in Mexico DF
            $country = Countries::where('name', '=', $location['country'])->first();
            $password = User::generatePassword();

            $user = User::create(['email' => $email,
                'name' => $username,
                'password' => $password,
                'country_id' => $country->id,
                'countryCode' => $location['isoCode'],
                'city' => $location['city'],
                'latitude' => $location['lat'],
                'longitude' => $location['lon']

            ]);
        } else {

            // User already exists
            // We check that this user isn't registered in this tournament

            if ($user->isRegisteredInTournament($tournamentId)) {
                // If so, send alert, must edit user instead of create
                flash('error', trans('flash.user_already_registered_in_tournament'));
//                $currentModelName = trans_choice('crud.tournament', 1) . " : " . $tournament->name;
                return redirect("tournaments/$tournamentId/users/create"); //, compact()

            }
        }
        // We add him to the different categor
        $tcus = array();
        $categories = array();
        foreach ($tcat as $tCategoryId) {
            array_push($tcus, ['category_tournament_id' => $tCategoryId,
                'user_id' => $user->id]);

            array_push($categories, trans(TournamentCategory::findOrFail($tCategoryId)->category->name));
        }

        TournamentCategoryUser::insert($tcus);
        // We send him an email with detail ( and user /password if new)
        $invite = new Invite();
        $code = $invite->generate($user->email, $tournament);
        $mailer->sendEmailInvitationTo($user->email, $tournament, $code, $categories, $password);
        flash('success', trans('core.operation_successful'));
        return redirect("tournaments/$tournamentId/users");


    }

    public function deleteUser($tournamentId, $tcId, $userId)
    {


        TournamentCategoryUser::where('category_tournament_id', $tcId)
            ->where('user_id', $userId)
            ->delete();
        flash('success', trans('core.operation_successful'));
        return redirect("tournaments/$tournamentId/users");
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tournament $tournament)
    {
        dd("show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournament $tournament)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TournamentRequest $request, Tournament $tournament)
    {

    }


}
