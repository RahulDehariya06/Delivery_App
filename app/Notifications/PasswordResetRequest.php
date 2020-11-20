<?php
namespace App\Notifications;use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;class PasswordResetRequest extends Notification implements ShouldQueue
{
    use Queueable;   
        /**
    * Create a new notification instance.
    *
    * @return void
    */
    protected $user;
    protected $token;
    protected $field;
    public function __construct($user, $token, $field)
    {
        //
        $this->user = $user;
        $this->token = $token;
        $this->field = $field;
    }    /**
    * Get the notification's delivery channels.
    *
    * @param  mixed  $notifiable
    * @return array
    */
    public function via($notifiable)
    {
        return ['mail'];
    }     /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
     public function toMail($notifiable)
     {

        $resetPwdUrl = url('password/reset/' . $this->token);
        return (new MailMessage)
            ->subject(trans('mail.reset_password_title'))
            ->line(trans('mail.reset_password_content_1'))
            ->line(trans('mail.reset_password_content_2'))
            ->action(trans('mail.reset_password_action'), $resetPwdUrl)
            ->line(trans('mail.reset_password_content_3'))
            ->salutation(trans('mail.footer_salutation', ['appName' => config('app.name')]));
    }    /**
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