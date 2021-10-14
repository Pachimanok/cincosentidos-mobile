<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class nuevoDespacho extends Mailable
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
       
        $this->datos = $datos;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $datos = $this->datos;
        return $this->view('emails.envioDespacho')
        ->subject('Nuevo Despacho ID: ' . $datos->id)
        ->attach(public_path() . '/' .'despachos/Despacho'.$datos->id.'.pdf');
       
    }
}
