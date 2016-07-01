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
        $appName = (app()->environment() == 'local' ? getenv('APP_NAME') : config('app.name'));
        //TODO Not translated
        $this->to = $user->email;
        $this->subject = trans('mail.activation_account') . " " . $appName;
        $this->view = 'emails.confirm';
        $this->data = compact('user');
        $this->deliver();
    }

    public function sendEmailInvitationTo($email, $tournament, $code, $category = null, $password = null)
    {
        $this->to = $email;
        $this->subject = trans('email.invite_to_tournament') . $tournament->name;
        $this->view = 'emails.invite';
        $this->data = compact('tournament', 'code', 'category', 'email', 'password');
        $this->deliver();
    }

    /**
     * Deliver the email.
     *
     * @return void
     */
    public function deliver()
    {
        $from = $this->from;
        $to = $this->to;
        $subject = $this->subject;

        $this->mailer->queue($this->view, $this->data, function ($message) use ($from, $to, $subject) {
            $appName = (app()->environment() == 'local' ? getenv('APP_NAME') : config('app.name'));

            $message->from($from, $appName)
                ->to($to)
                ->subject($subject);
        });
    }
}