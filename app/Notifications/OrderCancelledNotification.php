<?php

namespace App\Notifications;

use App\Models\ReprographyOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCancelledNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;
    public $reason;

    public function __construct(ReprographyOrder $order, string $reason)
    {
        $this->order = $order;
        $this->reason = $reason;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Votre commande #'.$this->order->id.' a été annulée')
            ->greeting('Bonjour '.$notifiable->client->fist_name.','.' '.$notifiable->client->last_name)
            ->line('Votre commande de reprographie a été annulée.')
            ->line('Raison : '.$this->reason)
            ->line('Détails de la commande :')
            ->line('- Numéro : #'.$this->order->id)
            ->line('- Services : '.$this->getServicesList())
            //->action('Créer une nouvelle commande', route('orders.create'))
            ->line('Vous pouvez créer une nouvelle commande ou nous contacter pour plus d\'informations.');
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'order_cancelled',
            'order_id' => $this->order->id,
            'message' => 'Votre commande #'.$this->order->id.' a été annulée',
            'reason' => $this->reason,
           // 'url' => route('orders.create')
        ];
    }

      private function getServicesList()
    {
        $services = collect($this->order->service_types)->map(function ($service) {
            $names = [
                'impression' => 'Impression',
                'photocopie' => 'Photocopie',
                'saisie_texte' => 'Saisie de texte',
                'tirage_photo' => 'Tirage photo',
                'carte_visite' => 'Carte de visite',
                'affiche' => 'Affiche',
                'flyers' => 'Flyers'
            ];
            return $names[$service] ?? $service;
        });

        return $services->join(', ');
    }
}