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
    protected $from = 'admin@kendozone.com';
    /**
     * The recipient of the email.
     *
     * @var string
     */
    protected $to;

    protected $subject;
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
        $appName = (app()->environment()=='local' ? getenv('APP_NAME') : config('app.name'));

        $this->to = $user->email;
        $this->subject = 'Activación de tu cuenta '.$appName;
        $this->view = 'emails.confirm';
        $this->data = compact('user');
        $this->deliver();
    }

    public function sendEmailInvitationTo( $email , $tournament, $code, $category = null, $password = null)
    {
        $this->to = $email;
        $this->subject = 'Invitación al torneo: '.$tournament->name;
        $this->view = 'emails.invite';
        $this->data = compact('tournament','code','category','email', 'password');
        $this->deliver();
    }

    /**
     * Deliver the email.
     *
     * @return void
     */
    public function deliver()
    {
        $appName = (app()->environment()=='local' ? getenv('APP_NAME') : config('app.name'));

        $this->mailer->send($this->view, $this->data, function ($message) {
            $message->from($this->from, $appName)
                ->to($this->to)
                ->subject($this->subject);
        });
    }
}