<?php

namespace App\Http\Controllers;

use App\Http\Requests\InviteRequest;
use App\Invite;
use App\Mailers\AppMailer;
use App\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use URL;

class InviteController extends Controller
{

    protected $currentModelName;
    protected $mailer;

    /**
     * InviteController constructor.
     * @param AppMailer $mailer
     */
    public function __construct(AppMailer $mailer)
    {

        $this->currentModelName = trans_choice('core.tournament_invitations', 1);
        View::share('currentModelName', $this->currentModelName);
        $this->mailer = $mailer;
    }


    /**
     * Display a listing of all invitations.
     *
     * @return View
     */
    public function index()
    {
        $invites = Auth::user()->invites()->with('tournament.owner')->paginate(config('constants.PAGINATION'));
        return view('invitation.index', compact('invites'));
    }

    /**
     * Display the UI for inviting competitors
     *
     * @param Tournament $tournament
     * @return View
     */
    public function create(Tournament $tournament)
    {
        // Should dd $tournament
        return view('invitation.show', compact('tournament'));
    }


    /**
     * Send an email to competitor and store invitation.
     *
     * @param InviteRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            $this->mailer->sendEmailInvitationTo($recipient, $tournament, $code);

        }
        flash()->success(trans('msg.invitation_sent'));

        return redirect(URL::action('TournamentController@edit', $tournament->slug));

    }

    /**
     * Consume registration.
     * Send to user creation, or categories selection
     * @param Request $request
     */
    public function consume(Request $request)
    {


    }

    /**
     * Send an email to competitor and store invitation.
     *
     * @param InviteRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $file = $request->file('invites')->store('invites');
        $tournament = Tournament::findBySlug($request->tournamentSlug);
        // Parse Csv File

        $reader = Excel::load("storage/app/" . $file, function ($reader) {
        })->get();

        // Checking if malformed email
        $reader->each(function ($sheet) use ($tournament) {

            // Loop through all rows
            $sheet->each(function ($row) use ($tournament) {
                // Check email
                if (!filter_var($row, FILTER_VALIDATE_EMAIL)) {
                    flash()->error(trans('msg.email_not_valid', ['email' => $row]));
                    return redirect(URL::action('TournamentController@show', $tournament->slug));
                }
            });
        });

        // Mass Invite
        $reader->each(function ($sheet) use ($tournament) {

            // Loop through all rows
            $sheet->each(function ($row) use ($tournament) {
                // Check email
                $invite = new Invite();
                $code = $invite->generateTournamentInvite($row, $tournament);
                $this->mailer->sendEmailInvitationTo($row, $tournament, $code);
            });
        });
        flash()->success(trans('msg.invitation_sent'));
        return redirect(URL::action('TournamentController@show', $tournament->slug));

    }


}
