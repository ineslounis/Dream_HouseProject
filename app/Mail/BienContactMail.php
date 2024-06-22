<?php

namespace App\Mail;

use App\Models\Bien;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BienContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;

    /**
     * Crée une nouvelle instance de message.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    public function build()
    {
        return $this->view('emails.bien_contact')
            ->to('ines.lounis@se.univ-bejaia.dz', 'Lounis') // Remplacez 'destinataire@example.com' par l'adresse email de votre destinataire
            ->with('mailData', $this->mailData);
    }
}
