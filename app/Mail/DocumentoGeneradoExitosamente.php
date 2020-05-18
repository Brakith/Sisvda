<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DocumentoGeneradoExitosamente extends Mailable
{
    use Queueable, SerializesModels;

    // Pubilca para que sea visible desde la vissta
    public $DatosEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($DatosEmail)
    {
        $this->DatosEmail = $DatosEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('Email.body');
        return $this->view('Email.documentogenerado');
    }
}
