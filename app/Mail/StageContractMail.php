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

class StageContractMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
      public $internshipRequest;
    public $clientName;


    public function __construct(Stage $internshipRequest, $clientName)
    {
        $this->internshipRequest = $internshipRequest;
        $this->clientName= $clientName;
    }

    public function build()
    {
        $pdfPath = Storage::path($this->internshipRequest->contract_path);
        $fileName = 'Contrat_Stage_'.$this->internshipRequest->id.'.pdf';

        return $this->subject('Votre Contrat de Stage - ' . config('app.name'))
            ->markdown('emails.internship_contract')
            ->with([
                'student' =>  session('clientInfo') ->fist_name. ' ' . session('clientInfo') ->last_name,
                'university' => $this->internshipRequest->university,
                'level' => $this->internshipRequest->level,
                'domaine' => $this->internshipRequest->domaine,
                'specialite' => $this->internshipRequest->specialite,
                'duration' => $this->internshipRequest->duration,
                'commune' => $this->internshipRequest->commune,
                'structure' => $this->internshipRequest->structure,
                'binome' => $this->internshipRequest->binome,
            ])
            ->attach($pdfPath, [
                'as' => $fileName,
                'mime' => 'application/pdf',
            ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Stage Contract Mail',
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
