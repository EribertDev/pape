<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class NotificationServiceClient extends Mailable
{
    use Queueable, SerializesModels;
    public $commande;
    public $client;
    /**
     * Create a new message instance.
     */
   /* public function __construct($commande, $client)
    {
        $this->commande = $commande;
        $this->client = $client;
        //
    }
*/
public function build()
{
    return $this->view('emails.NotificationServiceClient')
    ->with(['client' => session('clientInfo') ->fist_name])
    ->with(['prenom' => session('clientInfo')->last_name])
    ->with(['email'=>Auth::user()->email])
    ->with( ['telephone' => session('clientInfo')->phone_number])
  
    
   
        ->subject('Nouvelle Commande');
}




   /* public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouvelle commande recue',
        );
    }*/

    /**
     * Get the message content definition.
     */
    /*public function content(): Content
    {
        return new Content(
            view: 'emails.NotificationServiceClient', 
            with: [
                'commande' => $this->commande, // Passer la commande
                'client' => $this->client, // Passer le client
                //'payements' => $this->payements,
            ]
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
