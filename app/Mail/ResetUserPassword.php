<?php

namespace App\Mail;

use App\Models\Campaign;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetUserPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $notifiable;
    public $token;
    /** @var Campaign */
    public $campaign;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notifiable, $token)
    {
        $this->notifiable = $notifiable;
        $this->token = $token;
        $this->campaign = Campaign::findFromRoute();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->text("emails.reset_user_password")
            ->from(config("mail.from.address"), $this->campaign->name)
            ->subject("パスワード変更用URLのお知らせ ({$this->campaign->name}事務局)")
            ->to($this->notifiable->email)
            ;
    }
}
