<?php

namespace App\Notifications;

use App\Tournament;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class InviteCompetitor extends Notification
{
    use Queueable;

    protected $user, $tournament, $code, $category;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     * @param Tournament $tournament
     * @param $code
     * @param null $category
     */
    public function __construct(User $user, Tournament $tournament, $code, $category = null)
    {
        $this->user = $user;
        $this->tournament = $tournament;
        $this->code = $code;
        $this->category = $category;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        $subject = trans('mail.invite_to_tournament') . ": " . $this->tournament->name;
        $message = (new MailMessage)
            ->subject($subject)
            ->greeting(trans('mail.dear_kenshi'))
            ->line(trans('mail.you_are_invited_to_tournament') . ":" . $this->tournament->name);

        if ($this->tournament->venue_id != null) {
            $message
                ->line(trans('core.venue') . ': ' . $this->tournament->venue->name)
                ->line(trans('core.address') . ': ' . $this->tournament->venue->address);
        }
        $message
            ->line(trans('core.eventDateIni') . ': ' . $this->tournament->dateIni)
            ->line(trans('core.eventDateFin') . ': ' . $this->tournament->dateFin);

        if ($this->tournament->cost != null) {
            $message->line(trans('core.cost') . ': ' . $this->tournament->cost);
        }

        if ($this->tournament->registerDateLimit != null && $this->tournament->registerDateLimit != '0000-00-00') {
            $message->line(trans('core.limitDateRegistration') . ': ' . $this->tournament->limitDateRegistration);
        }
        if (isset($this->category)) {
            $message->line(trans('mail.you_have_been_preregistered'))
                ->line('- ' . $this->category);
        } else {
            $message->action(trans('mail.confirm_registration'), URL::action('ChampionshipController@create', ['tournamentSlug' => $this->tournament->slug, 'token' => $this->code]));
        }
        if ($this->user->password != null) {
            $message->line(trans('mail.your_connection_data') . ":")
                ->line(trans('core.username') . ":" . $this->user->email)
                ->line(trans('core.password') . ":" . $this->user->clearPassword);
        }
//        $message->line(trans('mail.dont_forget_to_pay'));


        if ($this->tournament->registerDateLimit != null && $this->tournament->registerDateLimit != '0000-00-00') {
            $message->line(trans('mail.before_day') . ":" . $this->tournament->registerDateLimit);
        }

        $message->line(trans('mail.thanks'));

        return $message;
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
