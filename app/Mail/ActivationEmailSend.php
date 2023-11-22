<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationEmailSend extends Mailable
{
    use Queueable, SerializesModels;

    public $mail;
    public $link;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail, $link)
    {
        $this->mail = $mail;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("noreply-minna@minna-printer.com", config('app.name'))
                    ->to($this->mail)
                    ->subject(trans('emails.activationSubject'))
                    ->view('emails.activation');
    }
}
