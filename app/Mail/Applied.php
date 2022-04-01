<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Applied extends Mailable
{
    use Queueable, SerializesModels;

    /** @var User */
    public $user;
    /** @var Campaign */
    public $campaign;
    /** @var Apply */
    public $apply;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $campaign, $apply)
    {
        $this->user = $user;
        $this->campaign = $campaign;
        $this->apply = $apply;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $blade = $this->apply->product->isGifteeBox() ? "emails.send_giftee" : "emails.applied";
        return $this->text($blade)
            ->from(config("mail.from.address"), $this->campaign->name)
            ->subject("景品交換受付のお知らせ ({$this->campaign->name}事務局)")
            ->to($this->user->email)
            ;
    }
}
