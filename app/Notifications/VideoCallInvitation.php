<?php

namespace App\Notifications;

use App\Models\VideoCall;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VideoCallInvitation extends Notification implements ShouldQueue
{
    use Queueable;

    public $videoCall;

    public function __construct(VideoCall $videoCall)
    {
        $this->videoCall = $videoCall;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Invitation à une visioconférence - Commande #' . $this->videoCall->commande_id)
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Une nouvelle visioconférence a été créée pour la commande #' . $this->videoCall->commande_id)
            ->line('**Créée par:** ' . $this->videoCall->creator->name)
            ->line('**Heure de début:** ' . $this->videoCall->starts_at->format('d/m/Y H:i'))
            ->line('**Lien pour rejoindre:**')
            ->action('Rejoindre la visioconférence', $this->videoCall->join_url)
            ->line('**Lien direct Jitsi:** ' . $this->videoCall->meeting_url)
            ->line('')
            ->line('Vous pouvez également consulter toutes les visioconférences depuis votre tableau de bord administrateur.')
            ->salutation('Cordialement,<br>Équipe ' . config('app.name'));
    }

    public function toArray($notifiable)
    {
        return [
            'video_call_id' => $this->videoCall->id,
            'commande_id' => $this->videoCall->commande_id,
            'message' => 'Nouvelle visioconférence pour la commande #' . $this->videoCall->commande_id
        ];
    }
}