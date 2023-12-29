<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmacaoInscricaoEvento extends Mailable
{
    use Queueable, SerializesModels;
    private $dadosEmail = null;
    private $pdfPath = null;
    private $pdfNome = null;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(object $dadosEmail,  $pdfPath, $pdfNome)
    {
        $this->dadosEmail = $dadosEmail;
        $this->pdfPath = $pdfPath;
        $this->pdfNome = $pdfNome;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.confirmacao-inscricao-evento', [
            'dadosEmail' => $this->dadosEmail
        ])->attach($this->pdfPath, [
            'as' => $this->pdfNome . '.pdf',
            'mime' => 'application/pdf',
        ])->subject('Confirmação de Inscrição'); 
    }
}