<?php

namespace App\Http\Controllers;

use App\Competitor;
use App\Exceptions\InvitationExpiredException;
use App\Exceptions\InvitationNeededException;
use App\Exceptions\InvitationNotActiveException;
use App\Grade;
use App\Http\Requests\ChampionshipRequest;
use App\Invite;
use App\Notifications\RegisteredToChampionship;
use App\Tournament;
use App\User;
use Auth;
use Illuminate\Auth\Access\AuthorizationException;
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
     * @throws AuthorizationException
     * @throws InvitationExpiredException
     * @throws InvitationNeededException
     * @throws InvitationNotActiveException
     */
    public function create($tournamentSlug, $token) //TODO Should not put token as part as URL, but as param
    {
        $currentModelName = trans('core.select_categories_to_register');
        $tournament = Tournament::where('slug', $tournamentSlug)->first();
        $grades = Grade::getAllPlucked();
        $invite = Invite::getInviteFromToken($token);

        if (is_null($invite)) throw new InvitationNeededException();
        if ($invite->hasExpired()) throw new InvitationExpiredException();
        if ($invite->active != 1) throw new InvitationNotActiveException();

        // Check if user is already registered
        $user = User::where('email', $invite->email)->first();
        if (is_null($user)) { // Redirect to user creation
            return view('auth/invite', compact('token'));
        }
        // If user is not confirmed, auto confirm him
        if ($user->verified == 0) {
            $user->verified = 1;
            $user->save();
        }
        // Redirect to register category Screen

        Auth::loginUsingId($user->id);
        return view("categories.register", compact('tournament', 'invite', 'currentModelName', 'grades'));
    }

    /**
     * Store a new championship, when registering categories
     * Invoked on save() after create() is called
     *
     * @param Tournament $tournament
     * @param ChampionshipRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Tournament $tournament, ChampionshipRequest $request)
    {
        $categories = $request->get('cat');

        if ($categories == null) {
            flash()->error(trans('msg.you_must_choose_at_least_one_championship'));
            return redirect()->back();
        }
        Auth::user()->updateUserFullName($request->firstname, $request->lastname);
        Auth::user()->championships()->detach();

        $existingCompetitor = Competitor::where('user_id', Auth::user()->id)
            ->whereIn('championship_id', $categories)->first();

        if ($existingCompetitor != null) {
            $shortId = $existingCompetitor->short_id;
        } else {
            $shortId = $tournament->competitors()->max('short_id') + 1;
        }

        foreach ($categories as $category) {
            Auth::user()->championships()->attach($category, ['confirmed' => 0, 'short_id' => $shortId]);
        }

        $tournament->owner->notify(new RegisteredToChampionship(Auth::user(), $tournament));

        flash()->success(trans('msg.tx_for_register_tournament', ['tournament' => $tournament->name]));
        return redirect(URL::action('UserController@getMyTournaments', Auth::user()));
    }
}
