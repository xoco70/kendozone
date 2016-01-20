<?php

namespace App\Http\Controllers;

use App\CategoryTournament;
use App\CategoryTournamentUser;
use App\Http\Requests;
use App\Mailers\AppMailer;
use App\Tournament;
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
        $tournament = Tournament::with('categoryTournaments.users', 'categoryTournaments.category')->find(1);
//        $tournament = Tournament::find($tournamentId)->first();
        $settingSize = sizeof($tournament->settings());
        $categorySize = sizeof($tournament->categories);

        $currentModelName = trans_choice('crud.competitor', 2) . " - " . trans_choice('crud.tournament', 1) . " : " . $tournament->name;
////        $users = $tournament->competitors();
//

//        dd($tournament->categoryTournaments);


        return view("tournaments/users", compact('tournament', 'currentModelName', 'settingSize', 'categorySize'));

    }

    /**
     * Show the form for creating a new competitor.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Tournament $tournament)
    {
        $categoryTournamentId = $request->get('categoryId');
        $currentModelName = trans_choice('crud.tournament', 1) . " : " . $tournament->name;
        return view("tournaments/users/create", compact('tournament', 'currentModelName', 'categoryTournamentId')); //, compact()
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
            'categoryTournamentId' => 'required',

        ]);

        $categoryTournamentId = $request->categoryTournamentId;
        $categoryTournament = CategoryTournament::findOrFail($categoryTournamentId);
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
            $user = User::with('categoryTournaments.tournament', 'categoryTournaments.category')->find($user->id);
            $categoryTournaments = $user->categoryTournaments();

            if ($categoryTournaments->get()->contains($categoryTournament)) {
                flash('error', trans('flash.user_already_registered_in_tournament'));
                return redirect()->back();

            } else {
                $categoryTournaments->attach($categoryTournamentId);
            }
        }


        // We send him an email with detail ( and user /password if new)
//        $invite = new Invite();
//        $code = $invite->generate($user->email, $tournament);
//        $mailer->sendEmailInvitationTo($user->email, $tournament, $code, null, $password);
        flash('success', trans('core.operation_successful'));
        return redirect("tournaments/$tournamentId/users");


    }

    public function deleteUser($tournamentId, $tcId, $userId)
    {


        CategoryTournamentUser::where('category_tournament_id', $tcId)
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
    public function edit(Tournament $tournament, User $user)
    {

        $user = User::with('categorytournaments.tournament', 'categoryTournaments.category')->find($user->id);
        dd($user->categoryTournaments);
        $currentModelName = trans_choice('crud.tournament', 1) . " : " . $tournament->name;
        return view("tournaments/users/edit", compact('tournament', 'currentModelName', 'user')); //, compact()

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tournamentId, $user)
    {

        $this->validate($request, [
            'cat' => 'required|array'

        ]);

        $tcat = $request->cat;

//        dd($user);

        // We add him to the different categor
        $tcusToCreate = array();
        $categories = array();
        foreach ($tcat as $tCategoryId) {
            array_push($tcusToCreate, ['category_tournament_id' => $tCategoryId,
                'user_id' => $user->id]);

            array_push($categories, trans(CategoryTournament::findOrFail($tCategoryId)->category->name));
        }

        // Get all TournamentCategories Related to this tournament
        // We can't just delete and create rows, because id is changing. We must delete and update existing
        // Making diff between old and new

        $categoriesTournement = CategoryTournament::where('tournament_id', $tournamentId)->lists('id');

        // Delete All Registered category
        CategoryTournamentUser::whereIn('category_tournament_id', $categoriesTournement)
            ->where('user_id', $user->id)
            ->delete();


        CategoryTournamentUser::insert($tcusToCreate);
        // We send him an email with detail ( and user /password if new)
//        $invite = new Invite();
//        $code = $invite->generate($user->email, $tournament);
//        $mailer->sendEmailInvitationTo($user->email, $tournament, $code, $categories, $password);
        flash('success', trans('core.operation_successful'));
        return redirect("tournaments/$tournamentId/users");
    }


}
