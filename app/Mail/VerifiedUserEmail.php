<?php

namespace App\Mail;

use App\Models\Campaign;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifiedUserEmail extends Mailable
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
    public function __construct($user)
    {
        $this->user = $user;
        $this->campaign = Campaign::findFromRoute();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if(request()->route("method") == "register") {
            $subject = "本登録完了のお知らせ";
        }
        else {
            $subject = "メールアドレス変更完了のお知らせ";
        }

        return $this->text("emails.verified_user_email")
            ->from(config("mail.from.address"), $this->campaign->name)
            ->subject("$subject ({$this->campaign->name}事務局)")
            ->to($this->user->email)
            ;
    }
}
