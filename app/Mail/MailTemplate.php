<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailTemplate extends Mailable
{
    use Queueable, SerializesModels;

    public $mail;
    public $sender;
    public $recipient;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail, $sender, $recipient) {
        $this->mail         = $mail;
        $this->sender       = $sender;
        $this->recipient    = $recipient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        $message = $this->from($this->sender->email)
                        ->subject($this->mail->subject)
                        ->to($this->recipient->email)
                        ->replyTo($this->sender->email)
                        ->view('mail.MailTemplate');

        return $message;
    }
}
