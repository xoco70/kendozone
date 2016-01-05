<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategorySettings;
use App\Http\Requests;
use App\Http\Requests\TournamentRequest;
use App\Invite;
use App\Mailers\AppMailer;
use App\Tournament;
use App\TournamentCategory;
use App\TournamentCategoryUser;
use App\TournamentLevel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;
use GeoIP;
use Webpatser\Countries\Countries;

//use App\Place;

class TournamentController extends Controller
{
    protected $currentModelName;

    public function __construct()
    {
        // Fetch the Site Settings object
//        $this->middleware('auth');
//        $this->currentModelName = trans_choice('crud.tournament', 1);
        $this->currentModelName = trans_choice('crud.tournament', 2);
        View::share('currentModelName', $this->currentModelName);
//        View::share('modelPlural', $this->modelPlural);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tournaments = Auth::user()->tournaments()->paginate(Config::get('constants.PAGINATION'));
//        $tournaments = Tournament::paginate(Config::get('constants.PAGINATION'));
//
//        dd($tournaments);
//        $tournaments = Tournament::where('user_id',Auth::user()->id)
//            ->paginate(Config::get('constants.PAGINATION'));;
//        $tournaments = Tournament::

//        dd($tournaments->first()->user->name);
        return view('tournaments.index', compact('tournaments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = TournamentLevel::lists('name', 'id');
        $categories = Category::lists('name', 'id');
        $tournament = new Tournament();
//        dd($categories);
//        $places = Place::lists('name', 'id');
        return view('tournaments.create', compact('levels', 'categories', 'tournament'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TournamentRequest $request)
    {
        $tournament = Auth::user()->tournaments()->create($request->all());
        $tournament->categories()->sync($request->input('category'));
        flash('success', trans('core.operation_successful'));
//        else flash('error', 'operation_failed!');
        return redirect("tournaments/$tournament->id/edit");
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
//        dd($tournament);
        $levels = TournamentLevel::lists('name', 'id');

        $categories = Category::lists('name', 'id');
//        $level = TournamentLevel::where("id","=",$tournament->level_id)->first();
//        $tournament->delete();
//        return redirect("tournaments");
        return view('tournaments.show', compact('tournament', 'categories', 'levels'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournament $tournament)
    {
//        dd($tournament);
        $categories = Category::lists('name', 'id');
        $levels = TournamentLevel::lists('name', 'id');
//        dd($tournament);
        return view('tournaments.edit', compact('tournament', 'levels', 'categories'));
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

        $tournament->update($request->all());
        $tournament->categories()->sync($request->input('category'));
        flash('success', trans('core.operation_successful'));
        return redirect("tournaments/$tournament->id/edit");
    }


    public function getUsers($tournamentId)
    {

        $tournament = Tournament::find($tournamentId)->first();
        $currentModelName = trans_choice('crud.competitor', 2) . " - " . trans_choice('crud.tournament', 1) . " : " . $tournament->name;
        $users = $tournament->competitors();


        return view("tournaments/users", compact('users', 'currentModelName'));
    }

    public function createUser($tournamentId)
    {


        $tournament = Tournament::findOrFail($tournamentId);
        $currentModelName = trans_choice('crud.tournament', 1) . " : " . $tournament->name;
        return view("tournaments/create_user", compact('tournament', 'currentModelName')); //, compact()
    }

    public function postUser(Request $request, $tournamentId, AppMailer $mailer)
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
            $country = Countries::where('name','=',$location['country'])->first();
            $password = User::generatePassword();

            User::create(['email' => $email,
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
                flash('warning', trans('flash.user_already_registered_in_tournament'));
//                $currentModelName = trans_choice('crud.tournament', 1) . " : " . $tournament->name;
                return redirect("tournaments/$tournamentId/users/create"); //, compact()

            } else {
                // We add him to the different categor
                $tcus = array();
                $categories = array();
                foreach ($tcat as $tCategoryId) {
                    array_push($tcus, ['category_tournament_id' => $tCategoryId,
                        'user_id' => $user->id]);

//                    dd(trans(TournamentCategory::findOrFail($tCategoryId)->category->name));
                    array_push($categories, trans(TournamentCategory::findOrFail($tCategoryId)->category->name));
                }

                TournamentCategoryUser::insert($tcus);
                // We send him an email with detail ( and user /password if new)
                $invite = new Invite();
                $code = $invite->generate($user->email, $tournament);
//                dd($code."-".$user->email);
                $mailer->sendEmailInvitationTo($user->email, $tournament,$code, $categories,$password);
                flash('success', trans('core.operation_successful'));
                return redirect("tournaments/$tournamentId/users");
            }


        }



    }


    public function deleteUser($tournamentId, $tcId, $userId)
    {
//        $tournament = Tournament::find($tournamentId)->first();

        TournamentCategoryUser::where('category_tournament_id', $tcId)
            ->where('user_id', $userId)
            ->delete();
        flash('success', trans('core.operation_successful'));
        return redirect("tournaments/$tournamentId/users");
    }


    public function updateCategory(Request $request, $categorySettingsId)
    {
        $categorySettings = CategorySettings::findOrFail($categorySettingsId);
        $categorySettings->update($request->all());
        flash("success", Lang::get('core.operation_successful'));
        return view("tournaments/categories", compact('categories'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroyTournament($tournamentId)
    {
        Tournament::destroy($tournamentId);
        flash("success", Lang::get('core.operation_successful'));
        return redirect("tournaments");
    }


}
