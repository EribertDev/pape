<?php

namespace App\Notifications;

use App\Models\ReprographyOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderAcceptedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;

    public function __construct(ReprographyOrder $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Votre commande de reprographie #'.$this->order->id.' a été acceptée')
            ->greeting('Bonjour '.$notifiable->client->fist_name.','.' '.$notifiable->client->last_name)
            ->line('Votre commande de reprographie a été acceptée et est en cours de traitement.')
            ->line('Détails :')
            ->line('- Numéro : #'.$this->order->id)
            ->line('- Services : '.$this->getServicesList())
            ->line('- Montant : '.number_format($this->order->total_cost, 0, ',', ' ').' FCFA')
            ->line('Merci pour votre confiance !');
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'order_accepted',
            'order_id' => $this->order->id,
            'message' => 'Votre commande #'.$this->order->id.' a été acceptée',
            //'url' => route('orders.show', $this->order->id)
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