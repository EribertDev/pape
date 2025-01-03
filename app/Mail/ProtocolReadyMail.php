<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProtocolReadyMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $service;
    public $theme;
    public $client;
    /**
     * Create a new message instance.
     */
    public function __construct($client,$theme,$service)
    {
        $this->service = $service;
        $this->theme = $theme;
        $this->client=$client;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Protocole Disponible',
        );
    }

    public function build()
    {
        return $this->view('emails.protocol_ready')
                ->with(['client' => $this->client,
                        
                    'theme' => $this->theme,
                    'service' => $this->service,])
                    
                ->subject('Protocole Disponible');
                
    }
    /**
     * Get the message content definition.
     */
   /* public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }*/

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
