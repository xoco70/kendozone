<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\InviteRequest;
use App\Invite;
use App\Mailers\AppMailer;
use App\Tournament;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
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
        $tournaments =
        $invites = Auth::user()->invites()->paginate(Config::get('constants.PAGINATION'));
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
    public function register($tournamentSlug, $token)
    {

        // Get available invitation
        $invite = Invite::getActiveInvite($token);

        // Check if invitation is expired
        $quote = null;
        if (is_null($invite)) $quote = trans('msg.invitation_needed');
        else {
            if ($invite->expiration < Carbon::now() && $invite->expiration != '0000-00-00') $quote = trans('msg.invitation_expired');
            if ($invite->active != 1) $quote = trans('msg.invitation_not_active');
        }


        if (!is_null($quote))
            return view('errors.general',
                ['code' => '403',
                    'message' => trans('core.forbidden'),
                    'quote' => $quote,
                    'author' => 'Admin',
                    'source' => '',
                ]
            );
        $currentModelName = trans('crud.select_categories_to_register');
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

                $tournament = Tournament::findBySlug($tournamentSlug);
                Auth::loginUsingId($user->id);
                return view("categories.register", compact('tournament', 'invite', 'currentModelName'));


            }
        } else {
            $invite = Invite::where('code', $token)->first();
            if (is_null($invite)) {
                return view('errors.general',
                    ['code' => '403',
                        'message' => trans('core.forbidden'),
                        'quote' => trans('msg.invitation_needed'),
                        'author' => 'Admin',
                        'source' => '',
                    ]
                );

            } else {
                return view('errors.general',
                    ['code' => '403',
                        'message' => trans('core.forbidden'),
                        'quote' => '',
                        'author' => 'Admin',
                        'source' => '',
                    ]
                );
            }
        }
    }

    public function registerCategories(Request $request)
    {
        //TODO Check if catgory has been paid. if so, can't change

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
                $invite->tournament_id = $tournament->id;
                $invite->active = 1;
                $invite->used = 1;
                $invite->save();
            }
        }


        if (isset($invite)) $invite->consume();
        //TODO core.operation_successful

        flash()->success(trans('core.operation_successful'));
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

        //TODO check that recipient is list of emails
        $this->validate($request, [
            'recipients' => 'required'
        ]);


        $tournament = Tournament::findBySlug($request->tournamentSlug);
        $recipients = json_decode($request->get("recipients"));
        foreach ($recipients as $recipient) {
            // Mail to Recipients
            $invite = new Invite();
            $code = $invite->generate($recipient, $tournament);
            $mailer->sendEmailInvitationTo($recipient, $tournament, $code);

        }
        //TODO core.operation_successful
        flash()->success(trans('core.operation_successful'));
        return redirect("tournaments/$tournament->slug/edit");


//        dd($recipients);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
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
