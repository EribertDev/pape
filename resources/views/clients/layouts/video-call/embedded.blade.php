@extends('clients.master-1')

@section('title', 'Visioconférence - Commande #' . $videoCall->commande->id)

@section('extra-style')
<style>
    .video-call-container {
        display: flex;
        flex-direction: column;
        height: 100vh;
        background: #1a2d62;
    }
    
    .video-header {
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        z-index: 1000;
    }
    
    .video-header h1 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 600;
    }
    
    .header-actions {
        display: flex;
        gap: 10px;
        align-items: center;
    }
    
    .header-info {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }
    
    .participant-count {
        font-size: 0.9rem;
        opacity: 0.8;
    }
    
    .timer {
        font-size: 0.9rem;
        font-weight: 500;
        color: #00c9a7;
    }
    
    .jitsi-frame-container {
        flex: 1;
        position: relative;
        overflow: hidden;
    }
    
    #jitsi-iframe {
        width: 100%;
        height: 100%;
        border: none;
    }
    
    .loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(26, 45, 98, 0.9);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        z-index: 100;
    }
    
    .loading-spinner {
        width: 50px;
        height: 50px;
        border: 5px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #00c9a7;
        animation: spin 1s ease-in-out infinite;
        margin-bottom: 20px;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    .control-bar {
        background: rgba(0, 0, 0, 0.7);
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .invite-section {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .invite-input {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 8px 12px;
        border-radius: 4px;
        min-width: 300px;
    }
    
    .btn-invite {
        background: #00c9a7;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s ease;
    }
    
    .btn-invite:hover {
        background: #00b89a;
    }
    
    .btn-end-call {
        background: #ff4757;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 500;
        transition: background 0.3s ease;
    }
    
    .btn-end-call:hover {
        background: #ff3742;
    }
    
    .notification-toast {
        position: fixed;
        top: 20px;
        right: 20px;
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        z-index: 2000;
        display: flex;
        align-items: center;
        gap: 10px;
        animation: slideIn 0.3s ease;
    }
    
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    .notification-icon {
        font-size: 1.2rem;
    }
</style>
@endsection

@section('page-content')
<div class="video-call-container" style="margin-top: 250px;">
    <div class="video-header">
        <h1>
            <i class="fas fa-video"></i> 
            Visioconférence - Commande #{{ $videoCall->commande->subject}}
        </h1>
        <div class="header-actions">
            <div class="header-info">
                <span class="timer" id="callTimer">00:00:00</span>
                <span class="participant-count" id="participantCount">1 participant</span>
            </div>
        </div>
    </div>
    
    <div class="jitsi-frame-container">
        <div class="loading-overlay" id="loadingOverlay">
            <div class="loading-spinner"></div>
            <p>Chargement de la visioconférence...</p>
        </div>
        <iframe 
            id="jitsi-iframe"
            src="{{ $videoCall->embed_url }}"
            allow="camera; microphone; display-capture; fullscreen; speaker; autoplay; clipboard-write;"
            onload="document.getElementById('loadingOverlay').style.display = 'none';"
        ></iframe>
    </div>
    
    <div class="control-bar">
        <div class="invite-section">
            <input 
                type="text" 
                class="invite-input" 
                id="inviteLink" 
                value="{{ $videoCall->embed_url }}"
                readonly
            >
            <button class="btn-invite" onclick="copyInviteLink()">
                <i class="fas fa-copy"></i> Copier le lien
            </button>
        </div>
        
        <button class="btn-end-call" onclick="endCall()">
            <i class="fas fa-phone-slash"></i> Quitter l'appel
        </button>
    </div>
</div>

<div id="notificationContainer"></div>
@endsection

@section('extra-scripts')
<script>
    let callStartTime = new Date();
    let timerInterval;
    
    // Démarrer le timer
    function startTimer() {
        timerInterval = setInterval(updateTimer, 1000);
    }
    
    function updateTimer() {
        const now = new Date();
        const diff = now - callStartTime;
        
        const hours = Math.floor(diff / 3600000);
        const minutes = Math.floor((diff % 3600000) / 60000);
        const seconds = Math.floor((diff % 60000) / 1000);
        
        document.getElementById('callTimer').textContent = 
            `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }
    
    function copyInviteLink() {
        const input = document.getElementById('inviteLink');
        input.select();
        document.execCommand('copy');
        
        showNotification('Lien copié dans le presse-papier!', 'success');
    }
    
    function endCall() {
        if (confirm('Êtes-vous sûr de vouloir quitter la visioconférence?')) {
            // Notifier le serveur que l'utilisateur a quitté
            fetch('{{ route('video-call.end', $videoCall->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(() => {
                window.location.href = '{{ route('dash.client') }}';
            });
        }
    }
    
    function showNotification(message, type = 'info') {
        const container = document.getElementById('notificationContainer');
        const notification = document.createElement('div');
        notification.className = 'notification-toast';
        
        let icon = 'fa-info-circle';
        if (type === 'success') icon = 'fa-check-circle';
        if (type === 'error') icon = 'fa-exclamation-circle';
        
        notification.innerHTML = `
            <i class="fas ${icon} notification-icon"></i>
            <span>${message}</span>
        `;
        
        container.appendChild(notification);
        
        // Supprimer la notification après 3 secondes
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
    
    // Démarrer le timer quand la page est chargée
    document.addEventListener('DOMContentLoaded', function() {
        startTimer();
        
        // Écouter les messages de l'iframe Jitsi
        window.addEventListener('message', function(event) {
            if (event.origin !== 'https://{{ config('services.jitsi.domain') }}') {
                return;
            }
            
            // Gérer les événements de Jitsi
            try {
                const data = JSON.parse(event.data);
                
                if (data.type === 'participant-joined') {
                    updateParticipantCount(data.count);
                } else if (data.type === 'participant-left') {
                    updateParticipantCount(data.count);
                }
            } catch (e) {
                // Ignorer les messages non JSON
            }
        });
    });
    
    function updateParticipantCount(count) {
        document.getElementById('participantCount').textContent = 
            count + (count === 1 ? ' participant' : ' participants');
    }
</script>
@endsection