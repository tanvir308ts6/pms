<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class ApplicantNotification extends Notification
{
    use Queueable;

    private string $username;
    private string $user_role;

    public function __construct(string $user, string $user_role)
    {
        $this->username = $user;
        $this->user_role = $user_role;
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(): MailMessage
    {
        $apply_status_url = url('/application-status');
        return (new MailMessage)
            ->subject(Lang::get('Successful Visit Request Submission'))
            ->line(Lang::get('Thank You') . " $this->username")
            ->line(Lang::get('You have been submitted an application as') . " $this->user_role")
            ->line(Lang::get('You Application is under review. After Approval you will get your visit pass through email'))
            ->action(Lang::get('Application Status'), $apply_status_url);
    }

}
