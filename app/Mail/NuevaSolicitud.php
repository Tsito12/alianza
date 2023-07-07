<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NuevaSolicitud extends Mailable
{
    use Queueable, SerializesModels;

    public $datos;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datos)
    {
        //
        $this->datos=$datos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $idcliente = $this->datos['idcliente'];
        $idsolicitud = $this->datos['idsolicitud'];
        return $this->subject('Solicitud de crédito registrada')->view('emails.nuevaSolicitud')->attachFromStorage('public/files/'.$idcliente.'/solicitudes/'.$idsolicitud.'.pdf');
    }
}
