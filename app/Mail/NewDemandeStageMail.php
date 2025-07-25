<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Stage;
use Illuminate\Support\Facades\Storage;

class NewDemandeStageMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
      public $internshipRequest;
       public $clientName;
    public function __construct(Stage $internshipRequest, $clientName)
    {
        //
        $this->internshipRequest = $internshipRequest;
        $this->clientName = $clientName;
    }

    public function build()
    {
        $email = $this->subject('Nouvelle Demande de Stage - ' .$this->clientName)
            ->markdown('emails.service_client_notification')
            ->with([
                'internshipRequest' => $this->internshipRequest,
                'studentName' =>  session('clientInfo') ->fist_name. ' ' . session('clientInfo') ->last_name,
            ]);

        // Joindre la lettre de recommandation
        $letterPath = Storage::path($this->internshipRequest->recommendation_letter_path);
        $fileName = 'Lettre_Recommandation_'.basename($letterPath);

        $email->attach($letterPath, [
            'as' => $fileName,
            'mime' => 'application/pdf',
        ]);

        // Joindre le contrat si disponible
        if ($this->internshipRequest->contract_path) {
            $contractPath = Storage::path($this->internshipRequest->contract_path);
            $contractName = 'Contrat_Stage_'.basename($contractPath);
            
            $email->attach($contractPath, [
                'as' => $contractName,
                'mime' => 'application/pdf',
            ]);
        }


        // Joindre le CIP si disponible
       if ($this->internshipRequest->cip) {
        $email->attachFromStorageDisk('cips', 
              basename($this->internshipRequest->cip),
              'CIP_Etudiant_'.basename($this->internshipRequest->cip).'.pdf');
    }


        return $email;
    }





    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Demande Stage Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
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
