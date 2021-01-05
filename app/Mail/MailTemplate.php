<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailTemplate extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $mail;
    public $sender;
    public $recipient;
    public $attachment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail, $sender, $recipient, $attachment) {
        $this->mail         = $mail;
        $this->sender       = $sender;
        $this->recipient    = $recipient;
        $this->attachment    = $attachment;
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
