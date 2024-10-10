<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends Notification
{
    use Queueable;
    

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Vérifiez votre adresse e-mail')
            ->greeting('Bonjour !') // Ajouter un salutation personnalisée,
            ->line('Merci de vous avoir inscrit SyRRaM !')
            ->line('Veuillez confirmer votre adresse e-mail en cliquant sur le lien ci-dessous :')
            ->action('Vérifier l\'email', $this->verificationUrl($notifiable))
            ->line('Si vous n\'avez pas créer de compte sur SyRRaM, vous pouvez ignorer ce message.')
            ->salutation('Cordialement,') // Ajouter une salutation personnalisée
            ->footer('L\'Equipe SyRRaM !'); // Ajouter un message dans le pied de page
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify', 
            now()->addMinutes(60), 
            ['id' => $notifiable->id, 'hash' => sha1($notifiable->email)]
        );
    }
    
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
