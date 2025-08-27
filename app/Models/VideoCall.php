<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class VideoCall extends Model
{
    use HasFactory;

    protected $fillable = [
        'commande_id',
        'created_by',
        'room_name',
        'room_password',
        'starts_at',
        'ends_at',
        'duration',
        'is_active',
        'participants',
        'admin_notified'
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'participants' => 'array',
        'is_active' => 'boolean',
        'admin_notified' => 'boolean'
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

  

    public function getMeetingUrlAttribute()
    {
        $url = "https://" . config('services.jitsi.domain') . "/" . $this->room_name;
        
        if ($this->room_password) {
            $url .= "#config.prejoinConfig.enabled=false&userInfo.displayName=" . urlencode($this->creator->name);
        }
        
        return $url;
    }


   
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }



    public function getJoinUrlAttribute()
    {
        return route('video-call.join', $this->id);
    }

    public function isCurrentlyActive()
    {
        return $this->is_active && 
               $this->starts_at <= now() && 
               (!$this->ends_at || $this->ends_at >= now());
    }

    public function addParticipant($userId, $userName)
    {
        $participants = $this->participants ?? [];
        
        if (!isset($participants[$userId])) {
            $participants[$userId] = [
                'name' => $userName,
                'joined_at' => now()->toDateTimeString(),
                'left_at' => null
            ];
            
            $this->participants = $participants;
            $this->save();
        }
    }

    public function markAsNotified()
    {
        $this->update(['admin_notified' => true]);
    }
    public function getEmbedUrlAttribute()
{
    $config = [
        'configOverwrite' => [
            'prejoinPageEnabled' => false,
            'disableModeratorIndicator' => false,
            'startAudioOnly' => false,
            'enableEmailInStats' => false,
            'enableWelcomePage' => false,
            'enableClosePage' => false,
        ],
        'interfaceConfigOverwrite' => [
            'SHOW_JITSI_WATERMARK' => false,
            'SHOW_WATERMARK_FOR_GUESTS' => false,
            'TOOLBAR_BUTTONS' => [
                'microphone', 'camera', 'closedcaptions', 'desktop', 'fullscreen',
                'fodeviceselection', 'hangup', 'profile', 'chat', 'recording',
                'livestreaming', 'etherpad', 'sharedvideo', 'settings', 'raisehand',
                'videoquality', 'filmstrip', 'invite', 'feedback', 'stats', 'shortcuts',
                'tileview', 'videobackgroundblur', 'download', 'help', 'mute-everyone',
                'mute-video-everyone', 'security'
            ],
        ],
        'userInfo' => [
            'displayName' => Auth::user()->name,
        ]
    ];

    $query = http_build_query($config);
    return "https://" . config('services.jitsi.domain') . "/" . $this->room_name . "?" . $query;
}


    public function removeParticipant($userId)
    {
        $participants = $this->participants ?? [];
        
        if (isset($participants[$userId])) {
            $participants[$userId]['left_at'] = now()->toDateTimeString();
            $this->participants = $participants;
            $this->save();
        }
    }
    public function endCall()
    {
        $this->is_active = false;
        $this->ends_at = now();
        $this->save();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                     ->where('starts_at', '<=', now())
                     ->where(function ($q) {
                         $q->whereNull('ends_at')
                           ->orWhere('ends_at', '>=', now());
                     });
    }

   
    
     
    public function prunable()
{
    return static::where('created_at', '<=', now()->subMonths(3));
}
}