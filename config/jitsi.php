<?php

return [
    'domain' => env('JITSI_DOMAIN', 'meet.jit.si'),
    'app_id' => env('JITSI_APP_ID'),
    'app_secret' => env('JITSI_APP_SECRET'),
    'options' => [
        'width' => '100%',
        'height' => 600,
        'parentNode' => '#jitsi-container',
        'configOverwrite' => [
            'prejoinPageEnabled' => false,
            'disableModeratorIndicator' => true,
            'startScreenSharing' => false,
            'enableEmailInStats' => false,
            'enableWelcomePage' => false,
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
    ],
];