<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\Commande;


class OrderReceivedSuccessfully extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $user;
    public $clientName;
    public $idCommande;
    

    public function __construct($idCommande)
    {
        //$this->clientName = $client;
        $this->idCommande = $idCommande;
    }

    public function build()
    {
        $commande = Commande::find($this->idCommande);

        return $this->view('emails.OrderReceivedSuccessfully')
            ->with(['client' => session('clientInfo') ->fist_name. ' ' . session('clientInfo')->last_name ] )
           ->with(['subject' => $commande->subject,
                'deadline' => $commande->deadline,
                'amount' => $commande->amount,
            ])
            ->subject('Confirmation de votre commande de rédaction via SyRRaM');
    }

    /**
     * Get the message envelope.
     */
   /* public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Received Successfully',
        );
    }*/

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
