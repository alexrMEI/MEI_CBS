<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
//use resources;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $key;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $key)
    {
        $this->key = $key;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Chave Adquirida')->SMTPSecure ('tls')->view('emails.mail');
    }
}
