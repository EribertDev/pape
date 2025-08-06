<?php

namespace App\Notifications;

use App\Models\ReprographyOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCompletedNotification extends Notification implements ShouldQueue
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
            ->subject('Votre commande #'.$this->order->id.' est prête')
            ->greeting('Bonjour '.$notifiable->client->fist_name.','.' '.$notifiable->client->last_name)
            ->line('Votre commande de reprographie est terminée et prête pour livraison.')
            ->line('Détails :')
            ->line('- Numéro : #'.$this->order->id)
            ->line('- Services : '.$this->getServicesList())
            ->line('- Mode de livraison : '.$this->getDeliveryMode())
           // ->action('Voir la commande', route('orders.show', $this->order->id))
            ->line('Nous vous contacterons bientôt pour la livraison.');
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'order_completed',
            'order_id' => $this->order->id,
            'message' => 'Votre commande #'.$this->order->id.' est prête',
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

    private function getDeliveryMode()
    {
        return $this->order->delivery_mode === 'Domicile' 
            ? 'Livraison à domicile' 
            : 'Point relais: '.$this->order->relay_point;
    }
}