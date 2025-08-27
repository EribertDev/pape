<?php

namespace App\Events;

use App\Models\VideoCall;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VideoCallCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $videoCall;
    public $invitationLink;

    public function __construct(VideoCall $videoCall)
    {
        $this->videoCall = $videoCall;
        $this->invitationLink = route('video-call.join', $videoCall->id);
    }

    public function broadcastOn()
    {
        return new Channel('video-calls.' . $this->videoCall->commande_id);
    }

    public function broadcastAs()
    {
        return 'video-call.created';
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->videoCall->id,
            'room_name' => $this->videoCall->room_name,
            'created_by' => $this->videoCall->creator->name,
            'starts_at' => $this->videoCall->starts_at->toDateTimeString(),
            'invitation_link' => $this->invitationLink,
            'meeting_url' => $this->videoCall->meeting_url
        ];
    }
}