@extends('clients.master-1')


@section('title', 'Visioconférence - Commande #' . $videoCall->commande->id)

@section('extra-style')
<style>
    .jitsi-container {
        width: 100%;
        height: 100vh;
        background: #1a2d62;
    }
    
    .jitsi-header {
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
    }
    
    .jitsi-header h1 {
        margin: 0;
        font-size: 1.5rem;
    }
    
    .jitsi-actions {
        display: flex;
        gap: 10px;
    }
    
    .jitsi-btn {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease;
    }
    
    .jitsi-btn:hover {
        background: rgba(255, 255, 255, 0.3);
    }
    
    .jitsi-btn-end {
        background: #ff4757;
    }
    
    .jitsi-btn-end:hover {
        background: #ff3742;
    }
    
    #jitsi-container {
        width: 100%;
        height: 100vh;
        padding-top: 70px;
    }
    
    .invitation-link {
        background: rgba(255, 255, 255, 0.1);
        padding: 10px;
        border-radius: 5px;
        margin-top: 10px;
        display: flex;
        align-items: center;
    }
    
    .invitation-link input {
        flex: 1;
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 5px 10px;
        border-radius: 3px;
        margin-right: 10px;
    }
    
    .copy-btn {
        background: #00c9a7;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 3px;
        cursor: pointer;
    }
</style>
@endsection

@section('page-content')
<div class="jitsi-container">
    <div class="jitsi-header">
        <h1>
            <i class="fas fa-video"></i> 
            Visioconférence - Commande #{{ $videoCall->commande->id }}
        </h1>
        <div class="jitsi-actions">
            <div class="invitation-link">
                <input type="text" id="invitationUrl" value="{{ $videoCall->meeting_url }}" readonly>
                <button class="copy-btn" onclick="copyInvitationLink()">
                    <i class="fas fa-copy"></i> Copier
                </button>
            </div>
            <button class="jitsi-btn jitsi-btn-end" onclick="endCall()">
                <i class="fas fa-phone-slash"></i> Terminer l'appel
            </button>
        </div>
    </div>
    
    <div id="jitsi-container"></div>
</div>
@endsection

@section('extra-scripts')
<script src='https://{{ config('services.jitsi.domain') }}/external_api.js'></script>
<script>
    const domain = '{{ config('services.jitsi.domain') }}';
    const options = {
        roomName: '{{ $videoCall->room_name }}',
        width: '100%',
        height: '100%',
        parentNode: document.querySelector('#jitsi-container'),
        userInfo: {
            displayName: '{{ $user->name }}',
            email: '{{ $user->email }}'
        },
        configOverwrite: {
            prejoinPageEnabled: false,
            disableModeratorIndicator: true,
            startScreenSharing: false,
            enableEmailInStats: false,
            enableWelcomePage: false,
            defaultLanguage: 'fr',
        },
        interfaceConfigOverwrite: {
            SHOW_JITSI_WATERMARK: false,
            SHOW_WATERMARK_FOR_GUESTS: false,
            APP_NAME: 'PAPE Visioconférence',
            NATIVE_APP_NAME: 'PAPE Visio',
            TOOLBAR_BUTTONS: [
                'microphone', 'camera', 'closedcaptions', 'desktop', 'fullscreen',
                'fodeviceselection', 'hangup', 'profile', 'chat', 'recording',
                'livestreaming', 'etherpad', 'sharedvideo', 'settings', 'raisehand',
                'videoquality', 'filmstrip', 'invite', 'feedback', 'stats', 'shortcuts',
                'tileview', 'videobackgroundblur', 'download', 'help', 'mute-everyone',
                'mute-video-everyone', 'security'
            ],
        }
    };

    // Initialiser Jitsi Meet
    const api = new JitsiMeetExternalAPI(domain, options);

    // Événements Jitsi
    api.addEventListener('videoConferenceJoined', () => {
        console.log('Rejoint la conférence');
    });

    api.addEventListener('videoConferenceLeft', () => {
        console.log('Quitté la conférence');
        // Notifier le serveur que l'utilisateur a quitté
        fetch('{{ route('video-call.leave', $videoCall->id) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(() => {
            window.close();
        });
    });

    api.addEventListener('participantJoined', (participant) => {
        console.log('Participant rejoint:', participant);
    });

    api.addEventListener('participantLeft', (participant) => {
        console.log('Participant parti:', participant);
    });

    // Fonctions utilitaires
    function copyInvitationLink() {
        const input = document.getElementById('invitationUrl');
        input.select();
        document.execCommand('copy');
        
        alert('Lien copié dans le presse-papier!');
    }

    function endCall() {
        if (confirm('Êtes-vous sûr de vouloir terminer la visioconférence?')) {
            fetch('{{ route('video-call.end', $videoCall->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    api.executeCommand('hangup');
                    setTimeout(() => {
                        window.close();
                    }, 2000);
                }
            });
        }
    }

    // Fermer proprement quand la page se ferme
    window.addEventListener('beforeunload', () => {
        fetch('{{ route('video-call.leave', $videoCall->id) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            keepalive: true
        });
    });
</script>
@endsection