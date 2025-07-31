<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\ProjectRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class NewProject extends Mailable
{
    use Queueable, SerializesModels;
    public $project;
    public $adminUrl;
    /**
     * Create a new message instance.
     */
    public function __construct(ProjectRequest $project)
    {
        //
         $this->project = $project;
        $this->adminUrl = route('projects.details', $project->id);
    }

        public function build()
    {
        $mail = $this->subject('Nouvelle demande d\'assistance projet - ' . $this->project->title)
                    ->markdown('emails.new_project')
                    ->with(['project' => $this->project]);

        // Ajouter la pièce jointe si le document existe
        if ($this->project->document_path && Storage::exists($this->project->document_path)) {
            $mail->attach(storage_path('app/' . $this->project->document_path), [
                'as' => 'document_projet.' . pathinfo($this->project->document_path, PATHINFO_EXTENSION),
                'mime' => Storage::mimeType($this->project->document_path),
            ]);
        }

        return $mail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Project',
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
