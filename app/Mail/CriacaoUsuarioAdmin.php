<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CriacaoUsuarioAdmin extends Mailable
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
        return $this->view('emails.criacao-user', [
            'dadosEmail' => $this->dadosEmail
        ])->subject('Usuário para acesso ao módulo ADMIN WBBF RJ '); 
    }
}