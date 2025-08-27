<?php

namespace App\Events;

use App\Models\VideoCall;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdminVideoCallNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $videoCall;
    public $message;

    public function __construct(VideoCall $videoCall, $message)
    {
        $this->videoCall = $videoCall;
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new Channel('admin.video-calls');
    }

    public function broadcastAs()
    {
        return 'video-call.notification';
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->videoCall->id,
            'commande_id' => $this->videoCall->commande_id,
            'room_name' => $this->videoCall->room_name,
            'created_by' => $this->videoCall->creator->name,
            'message' => $this->message,
            'embed_url' => $this->videoCall->embed_url,
            'created_at' => $this->videoCall->created_at->toDateTimeString(),
        ];
    }
}