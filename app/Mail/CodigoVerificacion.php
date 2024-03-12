<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CodigoVerificacion extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Código de verificación.
     *
     * @var string
     */
    public $codigo;

    /**
     * Create a new message instance.
     *
     * @param array $datosCorreo
     * @return void
     */
    public function __construct($datosCorreo)
    {
        $this->codigo = $datosCorreo['codigo'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Código de Verificación')
            ->view('login.correo');
    }
}
