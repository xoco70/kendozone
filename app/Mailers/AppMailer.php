<?php
namespace App\Mailers;
use App\User;
use Illuminate\Contracts\Mail\Mailer;
class AppMailer
{
    /**
     * The Laravel Mailer instance.
     *
     * @var Mailer
     */
    protected $mailer;
    /**
     * The sender of the email.
     *
     * @var string
     */
    protected $from = 'admin@atekokolli.com';
    /**
     * The recipient of the email.
     *
     * @var string
     */
    protected $to;
    /**
     * The view for the email.
     *
     * @var string
     */
    protected $view;
    /**
     * The data associated with the view for the email.
     *
     * @var array
     */
    protected $data = [];
    /**
     * Create a new app mailer instance.
     *
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }
    /**
     * Deliver the email confirmation.
     *
     * @param  User $user
     * @return void
     */
    public function sendEmailConfirmationTo(User $user)
    {
        $this->to = $user->email;
        $this->subjet = 'Activación de tu cuenta Kendonline';
        $this->view = 'emails.confirm';
        $this->data = compact('user');
        $this->deliver();
    }

    public function sendEmailInvitationTo($admin, $email, $tournamentName)
    {
        $this->to = $email;
        $this->subjet = 'Invitación al torneo $tournamentName';
        $this->view = 'emails.invite';
        $this->data = compact('user','admin','tournamentName');
        $this->deliver();
    }

    /**
     * Deliver the email.
     *
     * @return void
     */
    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function ($message) {
            $message->from($this->from, 'Kendonline')
                ->to($this->to);
        });
    }
}