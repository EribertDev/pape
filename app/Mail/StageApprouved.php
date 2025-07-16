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


class StageApprouved extends Mailable
{
    use Queueable, SerializesModels;
     public $internship;
    /**
     * Create a new message instance.
     */
    public function __construct( Stage $internship)
    {
        //
        $this->internship = $internship;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Stage Approuved',
        );
    }
      public function build()
    {
        $pdfPath = Storage::path($this->internship->authorization_path);
        $fileName = 'Autorisation_Stage_'.$this->internship->user->client->fist_name.'_'.$this->internship->user->client->last_name.'_'.$this->internship->binome.'.pdf';
        $email = $this->subject('Autorisation de Stage - ' . config('app.name'))
            ->markdown('emails.internship_authorization')
          
            ->attach($pdfPath, [
                'as' => $fileName,
                'mime' => 'application/pdf',
            ]);
        
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
