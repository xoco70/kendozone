<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountCreated extends Notification
{
    use Queueable;

    protected $user;

    /**
     * AccountCreated constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
        $subject = trans('mail.activation_account') . " " . $appName;

        return (new MailMessage)
            ->subject($subject)
            ->greeting(trans('mail.dear_kenshi'))
            ->line(trans('mail.user_invited_you', [
                'user' => $this->user->name,
                'appName' => $appName]))
            ->line(trans('mail.please_click_link_to_confirm_account'))
            ->action(trans('mail.activate_account'), url("/register/confirm/{$this->user->token}"))
            ->line(trans('mail.tx_for_signup'));
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
