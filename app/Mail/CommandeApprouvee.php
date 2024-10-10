<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CommandeApprouvee extends Mailable
{
    use Queueable, SerializesModels;

    public $commande;
    public $client;
    public $payements;

    /**
     * Create a new message instance.
     */
    public function __construct($commande, $client/*,$payements*/)
    {
        $this->commande = $commande;
        $this->client = $client;
       // $this->payements = $payements;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Commande Approuvée',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.CommandeApprouve', // Assure-toi que le chemin de la vue est correct
            with: [
                'commande' => $this->commande, // Passer la commande
                'client' => $this->client, // Passer le client
                //'payements' => $this->payements,
            ]
        );
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
