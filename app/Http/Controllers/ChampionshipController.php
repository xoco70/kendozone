<?php

namespace App\Http\Controllers;

use App\Exceptions\InvitationExpiredException;
use App\Exceptions\InvitationNeededException;
use App\Exceptions\InvitationNotActiveException;
use App\Http\Requests;
use App\Invite;
use App\Tournament;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class ChampionshipController extends Controller
{


    /**
     * Register a User to a Tournament
     * Triggered when User click Activation Link received in mail
     *
     * @param $tournamentSlug
     * @param $token
     * @return View
     * @throws InvitationExpiredException
     * @throws InvitationNeededException
     * @throws InvitationNotActiveException
     */
    public function create($tournamentSlug, $token)
    {
        $tournament = Tournament::findBySlug($tournamentSlug);
        $invite = Invite::getActiveTournamentInvite($token);

        // Check if invitation is expired
        $quote = null;

        if (is_null($invite)) throw new InvitationNeededException();
        if ($invite->expiration < Carbon::now() && $invite->expiration != '0000-00-00') throw new InvitationExpiredException();
        if ($invite->active != 1) throw new InvitationNotActiveException();


        $currentModelName = trans('core.select_categories_to_register');
        // Check if user is already registered
        if (!is_null($invite)) {
            $user = User::where('email', $invite->email)->first();
            if (is_null($user)) {
                // Redirect to user creation
                return view('auth/invite', compact('token'));
            } else {
                // If user is not confirmed, auto confirm him
                if ($user->verified == 0) {
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
                throw new AuthorizationException;
            }
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            $user->championships()->sync($categories);
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
        flash()->success(trans('msg.tx_for_register_tournament', ['tournament' => $tournament->name]));
        return redirect(URL::action('InviteController@index'));
    }
}
