<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\InviteRequest;
use App\Invite;
use App\Mailers\AppMailer;
use App\Tournament;
use App\TournamentCategory;
use App\TournamentCategoryUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class InviteController extends Controller
{

    protected $currentModelName;

    public function __construct()
    {
        $this->currentModelName = trans_choice('crud.tournament_invitations', 1);
        View::share('currentModelName', $this->currentModelName);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invites = Auth::user()->invites()->paginate(Config::get('constants.PAGINATION'));

        return view('invitation.index', compact('invites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Triggered when User click Activation Link received in mail
     *
     * @param  Request $request
     * @param  AppMailer $mailer
     */
    public function register($token)
    {


        // Get available invitation
        $invite = Invite::getActiveInvite($token);
        // Check if invitation is expired
        if ($invite->expiration < Carbon::now())
            dd ("Expired Invitation");
        $currentModelName = trans('crud.select_categories_to_register');
        // Check if user is already registered
        if (!is_null($invite)) {
            $user = User::where('email', $invite->email)->first();
            if (is_null($user)) {
                // Redirect to user creation
                return view('auth/invite', compact('token'));
            } else {
                // Redirect to register category Screen

                $tournamentId = $invite->tournament_id;
                $tournament = Tournament::findOrFail($tournamentId);
                Auth::loginUsingId($user->id);
                return view("categories.register", compact('tournament', 'invite', 'currentModelName'));


            }
        } else {
            $invite = Invite::where('code', $token)->first();
            if (is_null($invite)) {
                dd("No invitation");

            } else {
                dd("invitation used");
            }
        }
    }

    public function registerCategories(Request $request)
    {
        //TODO Check if catgory has been paid. if so, can't change

        $categories = $request->get('cat');
        $inviteId = $request->inviteId;
        $invite = Invite::findOrFail($inviteId);
        $tournament = $invite->tournament;

        // Get all TournamentCategories Related to this tournament

        $tcats = TournamentCategory::where('tournament_id', $tournament->id)->lists('id');

        // Delete All Registered category that has not been paid
        TournamentCategoryUser::whereIn('category_tournament_id', $tcats)
            ->where('user_id', Auth::user()->id)
            ->delete();

        //Create new ones
        $arrToSave = array();
        foreach ($categories as $cat) {
            array_push($arrToSave, ['category_tournament_id' => $cat, 'user_id' => Auth::user()->id, 'confirmed' => 0]);
        }

        TournamentCategoryUser::insert($arrToSave);

        $invite->consume();
        flash("success", trans('core.operation_successful'));
        return redirect("/invites");

    }

    /**
     * Send an email to competitor and store invitation.
     *
     * @param InviteRequest|Request $request
     * @param AppMailer $mailer
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AppMailer $mailer)
    {
        $this->validate($request, [
            'recipients' => 'required'
        ]);


        $tournament = Tournament::findOrFail($request->get("tournamentId"));
        $recipients = json_decode($request->get("recipients"));
        foreach ($recipients as $recipient) {
            // Mail to Recipients
            $invite = new Invite();
            $code = $invite->generate($recipient, $tournament);
            $mailer->sendEmailInvitationTo($recipient, $tournament, $code);

        }
        flash('success', trans('core.operation_successful'));
        return redirect("tournaments/$tournament->id/edit");


//        dd($recipients);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($tournamentId)
    {
        $tournament = Tournament::find($tournamentId);
        return view('invitation.show', compact('tournament'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
