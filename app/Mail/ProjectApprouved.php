<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\ProjectRequest;

class ProjectApprouved extends Mailable
{
    use Queueable, SerializesModels;

     public $project;
    public $paymentUrl;
    public $deadlineDate;

    public function __construct(ProjectRequest $project)
    {
        $this->project = $project;
        $this->paymentUrl ="";
        $this->deadlineDate = now()->addDays(7)->format('d/m/Y');
    }

    public function build()
    {
        return $this->subject('Votre projet a été approuvé ! - Prêt pour le paiement')
                    ->view('emails.project_approuved');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Project Approuved',
        );
    }

    /**
     * Get the message content definition.
     */
  

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
