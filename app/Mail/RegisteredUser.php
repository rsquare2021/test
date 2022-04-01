<?php

namespace App\Mail;

use App\Models\Campaign;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisteredUser extends Mailable
{
    use Queueable, SerializesModels;

    public $notifiable;

    /** @var string */
    public $verification_url;

    /** @var Campaign */
    public $campaign;

    public $method;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notifiable, $verification_url)
    {
        $this->notifiable = $notifiable;
        $this->verification_url = $verification_url;
        $this->campaign = Campaign::findFromRoute();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if(request()->routeIs("campaign.register")) {
            $subject = "[仮登録完了] 本登録用URLのお知らせ";
            $this->method = "register";
        }
        else {
            $subject = "[仮登録完了] メールアドレス変更確認用URLのお知らせ";
            $this->method = "update";
        }

        return $this->text("emails.register_from_email")
            ->from(config("mail.from.address"), $this->campaign->name)
            ->subject("$subject ({$this->campaign->name}事務局)")
            ->to($this->notifiable->email)
            ;
    }
}
