<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contato extends Mailable
{
    use Queueable, SerializesModels;
    private $dadosEmail = null;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $dadosEmail)
    {
        $this->dadosEmail = $dadosEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contato', [
            'dadosEmail' => $this->dadosEmail
        ])->subject('Solicitação de Contato via SITE WBBF RJ'); 
    }
}