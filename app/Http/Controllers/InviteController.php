<?php

namespace App\Http\Controllers;

use App\Exceptions\InvitationExpiredException;
use App\Exceptions\InvitationNeededException;
use App\Exceptions\InvitationNotActiveException;
use App\Http\Requests;
use App\Http\Requests\InviteRequest;
use App\Invite;
use App\Mailers\AppMailer;
use App\Tournament;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\UnauthorizedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use URL;

class InviteController extends Controller
{

    protected $currentModelName;

    public function __construct()
    {
        $this->currentModelName = trans_choice('core.tournament_invitations', 1);
        View::share('currentModelName', $this->currentModelName);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invites = Auth::user()->invites()->with('tournament.owner')->paginate(Config::get('constants.PAGINATION'));
        return view('invitation.index', compact('invites'));
    }
//user has a lot of tournament through invites
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
     * @param $tournamentSlug
     * @param $token
     * @return View
     * @internal param $tournamentId
     * @internal param Request $request
     * @internal param AppMailer $mailer
     */
    public function registerTournamentInvite($tournamentSlug, $token)
    {
        $tournament = Tournament::findBySlug($tournamentSlug);

        // Get available invitation
        $invite = Invite::getActiveTournamentInvite($token);

        // Check if invitation is expired
        $quote = null;
        if (is_null($invite)) throw new InvitationNeededException();
        else {
            if ($invite->expiration < Carbon::now() && $invite->expiration != '0000-00-00') throw new InvitationExpiredException();
            if ($invite->active != 1) throw new InvitationNotActiveException();
        }

        
        $currentModelName = trans('core.select_categories_to_register');
        // Check if user is already registered
        if (!is_null($invite)) {
            $user = User::where('email', $invite->email)->first();
            if (is_null($user)) {
                // Redirect to user creation
                return view('auth/invite', compact('token'));
            } else {
                // If user is not confirmed, auto confirm him
                if ($user->verified == 0){
                    $user->verified = 1;
                    $user->save();
                }


                // Redirect to register category Screen

                Auth::loginUsingId($user->id);
                return view("categories.register", compact('tournament', 'invite', 'currentModelName'));


            }
        } else {
            $invite = Invite::where('code', $token)->first();
            if (is_null($invite)) {
                throw new InvitationNeededException();

            } else {
                throw new UnauthorizedException;
            }
        }
    }

    public function registerCategories(Request $request)
    {
        $categories = $request->get('cat');
        $inviteId = $request->inviteId;
        if ($inviteId != 0)
            $invite = Invite::findOrFail($inviteId);
        else
            $invite = null;

        $tournamentSlug = $request->tournament;
        $tournament = Tournament::findBySlug($tournamentSlug);

        if ($tournament->isOpen() || $tournament->needsInvitation() || !is_null($invite)) {
            $user = User::find(Auth::user()->id);
            $user->categoryTournaments()->sync($categories);
            if (is_null($invite)) {
                $invite = new Invite();
                $invite->code = 'open';
                $invite->email = Auth::user()->email;
                $invite->object_type = 'App\Tournament';
                $invite->object_id = $tournament->id;
                $invite->active = 1;
                $invite->used = 1;
                $invite->save();
            }
        }


        if (isset($invite)) $invite->consume();
        flash()->success(trans('msg.tx_for_register_tournament', ['tournament' =>$tournament->name]));
        return redirect(URL::action('InviteController@index'));

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

        //TODO check that recipient is list of emails
        $this->validate($request, [
            'recipients' => 'required'
        ]);


        $tournament = Tournament::findBySlug($request->tournamentSlug);
        $recipients = json_decode($request->get("recipients"));
        foreach ($recipients as $recipient) {
            // Mail to Recipients
            $invite = new Invite();
            $code = $invite->generateTournamentInvite($recipient, $tournament);
            $mailer->sendEmailInvitationTo($recipient, $tournament, $code);

        }
        flash()->success(trans('msg.invitation_sent'));

        return redirect(URL::action('TournamentController@edit', $tournament->slug));


//        dd($recipients);
    }

    /**
     * Display the specified resource.
     *
     * @param $tournamentSlug
     * @return \Illuminate\Http\Response
     */
    public function inviteUsers($tournamentSlug)
    {
        $tournament = Tournament::findBySlug($tournamentSlug);
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
