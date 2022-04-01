<?php

namespace App\Notifications\User;

use App\Mail\RegisteredUser;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends VerifyEmailNotification
{
    public function toMail($notifiable)
    {
        return new RegisteredUser($notifiable, $this->verificationUrl($notifiable));
    }

    protected function verificationUrl($notifiable)
    {
        if(request()->routeIs("campaign.register")) {
            $method = "register";
        }
        else {
            $method = "update";
        }

        return URL::temporarySignedRoute(
            'campaign.verification.verify',
            Carbon::now()->addDay(),
            [
                'campaign_id' => request()->route("campaign_id"),
                'method' => $method,
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}
