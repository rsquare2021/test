<?php

namespace App\Notifications\User;

use App\Mail\ResetUserPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

class ResetPassword extends ResetPasswordNotification
{
    public function toMail($notifiable)
    {
        return new ResetUserPassword($notifiable, $this->token);
    }
}
