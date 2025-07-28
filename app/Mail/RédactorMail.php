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
    public $fiche_technique;
    /**
     * Create a new message instance.
     */
    public function __construct($commande, $clientInfo,$filePath,$fiche_technique)
    {
        $this->commande = $commande;
       $this->clientInfo=$clientInfo;
       $this->filePath = $filePath;
       $this->fiche_technique=$fiche_technique;
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
       

       
        
        $email = $this->view('emails.RedactorEmail')
                ->with(['commande' => $this->commande,
                        
                        'clientInfo' => $this->clientInfo,])
                        ->attach($this->filePath, [
                            'as' => $originalFileName, // Nom personnalisé
                            'mime' => $mimeType,
                        ])
                    
                ->subject('Nouvelle commande de rédaction assignée à votre compte');

                if ($this->fiche_technique) {
                    $ficheTechniqueName = pathinfo($this->fiche_technique, PATHINFO_BASENAME);
                            $mimeType1 = mime_content_type($this->fiche_technique);

                    $email->attach($this->fiche_technique, [
                        'as' => $ficheTechniqueName,
                        'mime' => $mimeType1,
                    ]);
                }



        return $email;
                
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
