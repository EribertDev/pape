<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RédactorMail extends Mailable
{
    use Queueable, SerializesModels;
    public $commande; 
    public  $clientInfo;
    /**
     * Create a new message instance.
     */
    public function __construct($commande, $clientInfo)
    {
        $this->commande = $commande;
       $this->clientInfo=$clientInfo;
    }

    /**
     * Get the message envelope.
     */
 /*   public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Rédactor Mail',
        );
    }*/

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->view('emails.RedactorEmail')
                ->with(['commande' => $this->commande,
                        
                        'clientInfo' => $this->clientInfo,])
                ->subject('Nouvelle commande de rédaction assignée à votre compte');
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
