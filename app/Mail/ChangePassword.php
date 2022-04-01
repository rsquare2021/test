<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangePassword extends Mailable
{
    use Queueable, SerializesModels;

    /** @var User */
    public $user;
    /** @var Campaign */
    public $campaign;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $campaign)
    {
        $this->user = $user;
        $this->campaign = $campaign;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->text("emails.change_password")
            ->from(config("mail.from.address"), $this->campaign->name)
            ->subject("パスワード更新のお知らせ ({$this->campaign->name}事務局)")
            ->to($this->user->email)
            ;
    }
}
