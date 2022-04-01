<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactSendmail extends Mailable
{
    use Queueable, SerializesModels;

    private $email;
    private $contact;
    private $contact_type;
    private $contact_tel;
    private $contact_id;

    /** @var Campaign */
    public $campaign;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact, $campaign, $contact_id)
    {
        $this->email = $contact['email'];
        $this->contact = $contact['contact'];
        $this->contact_type = $contact['contact_type'];
        $this->contact_tel = $contact['contact_tel'];
        $this->campaign = $campaign;
        $this->contact_id = $contact_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->text("emails.contact")->with([
                'email' => $this->email,
                'contact' => $this->contact,
                'contact_type' => $this->contact_type,
                'contact_tel' => $this->contact_tel,
                'campign' => $this->campaign,
                'contact_id' => $this->contact_id,
            ])
            ->from(config("mail.from.address"), $this->campaign->name)
            ->subject("お問い合わせ受付のお知らせ ({$this->campaign->name}事務局)")
            ;
    }
}
