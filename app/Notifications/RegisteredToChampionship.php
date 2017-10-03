<?php

namespace App\Notifications;

use App\Tournament;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegisteredToChampionship extends Notification
{
    use Queueable;

    protected $user, $tournament, $registeredChampionships;

    /**
     * AccountCreated constructor.
     * @param User $user
     */
    public function __construct(User $user, Tournament $tournament)
    {
        $this->user = $user;
        $this->tournament = $tournament;
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
        $appName = (app()->environment() == 'local' ? getenv('APP_NAME') : config('app.name'));
        $subject = $appName . " - " . trans('msg.user_has_registered_to_tournament',
                ['user_name' => $this->user->name,
                    'tournament' => $this->tournament->name]);

        $message = (new MailMessage)
            ->subject($subject)
            ->greeting(trans('mail.dear_kenshi'))
            ->line(trans('msg.user_has_registered_to_championships',
                ['user_name' => $this->user->name]));

        foreach ($this->user->championships as $championship) {
            $message->line(" <strong>- " . $championship->category->name . "</strong>");
        }
        $message->line(trans('msg.success_to_all'));
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
