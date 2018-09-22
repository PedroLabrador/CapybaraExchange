<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PagoAprobado extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $payment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $payment)
    {
        $this->user = $user;
        $this->payment = $payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@capybaraexchange.com')
                    ->view('mail.allow');
    }
}