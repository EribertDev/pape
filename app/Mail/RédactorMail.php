<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class RédactorMail extends Mailable
{
    use Queueable, SerializesModels;
    public $commande; 
    public  $clientInfo;
    public $filePath;
    /**
     * Create a new message instance.
     */
    public function __construct($commande, $clientInfo,$filePath)
    {
        $this->commande = $commande;
       $this->clientInfo=$clientInfo;
       $this->filePath = $filePath;
       
    } 

    /**
     * Get the message envelope.
     */
   public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Rédactor Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {  
        $originalFileName = pathinfo($this->filePath, PATHINFO_BASENAME); 
        $mimeType = mime_content_type($this->filePath);


        return $this->view('emails.RedactorEmail')
                ->with(['commande' => $this->commande,
                        
                        'clientInfo' => $this->clientInfo,])
                        ->attach($this->filePath, [
                            'as' => $originalFileName, // Nom personnalisé
                            'mime' => $mimeType,
                        ])
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
