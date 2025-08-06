<?php

namespace App\Notifications;

use App\Models\ReprographyOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderRejectedNotification extends Notification implements ShouldQueue
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
            ->subject('Votre commande de reprographie #'.$this->order->id.' a été rejetée')
            ->greeting('Bonjour '.$notifiable->client->fist_name.','.' '.$notifiable->client->last_name)
            ->line('Votre commande de reprographie n\'a pas pu être acceptée.')
            ->line('Raison : '.$this->reason)
            ->line('Détails de la commande :')
            ->line('- Numéro : #'.$this->order->id)
            ->line('- Services : '.$this->getServicesList())
            //->action('Modifier la commande', route('orders.edit', $this->order->id))
            ->line('Vous pouvez modifier et resoumettre votre commande ou nous contacter pour plus d\'informations.');
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'order_rejected',
            'order_id' => $this->order->id,
            'message' => 'Votre commande #'.$this->order->id.' a été rejetée',
            'reason' => $this->reason,
            //'url' => route('orders.edit', $this->order->id)
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