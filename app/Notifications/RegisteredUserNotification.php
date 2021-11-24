<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class RegisteredUserNotification extends Notification
{
    use Queueable;

    private string $username;
    private string $user_role;
    private string $password;

    public function __construct(string $user, string $user_role, string $password)
    {
        $this->username = $user;
        $this->user_role = $user_role;
        $this->password = $password;
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(): MailMessage
    {
        $login_url = url('/login');
        return (new MailMessage)
            ->subject(Lang::get('Successful user registration'))
            ->line(Lang::get('Welcome') . " $this->username")
            ->line(Lang::get('You have been registered in the system with the role of') . " $this->user_role")
            ->line(Lang::get('The generated password is:') . " $this->password")
            ->line(Lang::get('You can now login by selecting the following option'))
            ->action(Lang::get('Login'), $login_url)
            ->line(Lang::get('Remember: change your password when you verify your email and login to the system.'));
    }

}
