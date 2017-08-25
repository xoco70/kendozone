<?php

namespace App\Http\Controllers;

use App\Championship;
use App\Competitor;
use App\Exceptions\InvitationExpiredException;
use App\Exceptions\InvitationNeededException;
use App\Exceptions\InvitationNotActiveException;
use App\Grade;
use App\Invite;
use App\Notifications\RegisteredToChampionship;
use App\Tournament;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Xoco70\LaravelTournaments\Models\ChampionshipSettings;

class ChampionshipController extends Controller
{


    /**
     * Register a User to a Tournament
     * Triggered when User click Activation Link received in mail
     *
     * @param $tournamentSlug
     * @param $token
     * @return View
     * @throws AuthorizationException
     * @throws InvitationExpiredException
     * @throws InvitationNeededException
     * @throws InvitationNotActiveException
     */
    public function create($tournamentSlug, $token)
    {

        $tournament = Tournament::where('slug', $tournamentSlug)->first();
        $grades = Grade::getAllPlucked();
        $invite = Invite::getInviteFromToken($token);

        // Check if invitation is expired

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
                return view("categories.register", compact('tournament', 'invite', 'currentModelName', 'grades'));
            }
        }
        throw new InvitationNeededException();
    }

    /**
     * Store a new championship
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categories = $request->get('cat');
        $tournament = Tournament::where('slug', $request->tournament)->first();

        $invite = Invite::getInvite($request, $tournament);

        if ($tournament->isOpen() || $tournament->needsInvitation() || !is_null($invite)) {
            $user = User::find(Auth::user()->id);
            if ($categories != null) {
                Auth::user()->updateUserFullName($request->firstname, $request->lastname);
                $user->championships()->detach();

                $existingCompetitor = Competitor::where('user_id', $user->id)
                    ->whereIn('championship_id', $categories)->first();

                if ($existingCompetitor != null) {
                    $shortId = $existingCompetitor->short_id;
                } else {
                    $shortId = $tournament->competitors()->max('short_id') + 1;
                }

                foreach ($categories as $category) {
                    $user->championships()->attach($category, ['confirmed' => 0, 'short_id' => $shortId]);
                }

                $tournament->owner->notify(new RegisteredToChampionship($user, $tournament));
            } else {
                flash()->error(trans('msg.you_must_choose_at_least_one_championship'));
                return redirect()->back();

            }
            if (is_null($this)) {
                $invite->saveItem($tournament);
            }

        }

        flash()->success(trans('msg.tx_for_register_tournament', ['tournament' => $tournament->name]));
        return redirect(URL::action('UserController@getMyTournaments', Auth::user()));
    }

}
