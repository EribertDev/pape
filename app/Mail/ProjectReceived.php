<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\ProjectRequest;
 

class ProjectReceived extends Mailable
{
    use Queueable, SerializesModels;
    public $project;
    public $paymentUrl;
    /**
     * Create a new message instance.
     */
   

       public function __construct(ProjectRequest $project)
    {
        $this->project = $project;
        $this->paymentUrl = route('projects.payment', $project->id);
    }

    public function build()
    {
        return $this->subject('Confirmation de réception de la demande d\'assistance projet')
                    ->markdown('emails.project_received');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Project Received',
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
