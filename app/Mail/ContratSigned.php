<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Models\Stage;

class ContratSigned extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $internship;
    public $clientName;
    public function __construct($internship, $clientName)
    {
        //
        $this->internship = $internship;
        $this->clientName = session('clientInfo')->fist_name . ' ' . session('clientInfo')->last_name;
    }

       public function build()
    {
        $student = session('clientInfo')->fist_name . ' ' . session('clientInfo')->last_name;
        $pdfPath = Storage::path($this->internship->signed_contract_path);
        $fileName = 'Contrat_Signé_' . $this->internship->binome.'_'. $student. '.pdf';

        return $this->subject('Contrat Signé - ' . config('app.name'))
            ->markdown('emails.contrat_signed')
            ->with([
                'student' =>  session('clientInfo') ->fist_name. ' ' . session('clientInfo') ->last_name,
                'university' => $this->internship->university,
                'level' => $this->internship->level,
                'domaine' => $this->internship->domaine,
                'specialite' => $this->internship->specialite,
                'duration' => $this->internship->duration,
                'commune' => $this->internship->commune,
                'structure' => $this->internship->structure,
                'binome' => $this->internship->binome,
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
            subject: 'Contrat Signed',
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
