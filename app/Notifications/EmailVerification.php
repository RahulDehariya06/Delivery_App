<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Notifications\Notification;

class EmailVerification extends Notification
{
    use Queueable;
    protected $entity;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $verificationUrl = url('users/verify/email/' . $this->entity->email_token);
        
        return (new MailMessage)
            ->subject(trans('mail.email_verification_title'))
            ->greeting(trans('mail.email_verification_content_1', ['userName' => $this->entity->name]))
            ->line(trans('mail.email_verification_content_2'))
            ->action(trans('mail.email_verification_action'), $verificationUrl)
            ->line(trans('mail.email_verification_content_3'))
            ->salutation(trans('mail.footer_salutation'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
