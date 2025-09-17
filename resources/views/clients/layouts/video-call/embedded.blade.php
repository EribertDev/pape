@extends('clients.master-1')

@section('title', 'Visioconférence - Commande #' . $videoCall->commande->id)

@section('extra-style')
<style>

      .remote-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        .session-card {
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .remote-screen {
            background-color: #2c3e50;
            border-radius: 5px;
            height: 400px;
            overflow: hidden;
        }
        .control-tools {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 15px;
        }
        .connection-status {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 5px;
        }
        .status-connected { background-color: #28a745; }
        .status-disconnected { background-color: #dc3545; }
        .status-connecting { background-color: #ffc107; }
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
    /* Quill editor styles */
    .ql-container { min-height: 350px; background: #ffffff; }
    .ql-toolbar.ql-snow { border-top-left-radius: 6px; border-top-right-radius: 6px; }
    .ql-container.ql-snow { border-bottom-left-radius: 6px; border-bottom-right-radius: 6px; }
</style>
<link rel="stylesheet" href="https://unpkg.com/quill@1.3.7/dist/quill.snow.css">
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
<!-- Section pour les documents collaboratifs -->
<div class="card mt-4">
    <div class="card-header">
        <h4><i class="fas fa-file-word me-2"></i>Édition Collaborative de Documents</h4>
    </div>
    <div class="card-body">
        <!-- Interface d'upload pour l'admin -->
       
        <div class="mb-4 p-3 border rounded">
            <h5><i class="fas fa-upload me-2"></i>Ajouter un document</h5>
            <div class="mb-3">
                <input type="file" class="form-control" id="collaborativeDocUpload" accept=".docx,.doc">
                        <input type="hidden" id="videoCallId" value="{{ $videoCall->id }}">

                <div class="form-text">Formats acceptés: .docx, .doc (max 10MB)</div>
            </div>
            <button class="btn btn-primary" onclick="uploadCollaborativeDocument({{ $videoCall->commande->id }})">
                <i class="fas fa-upload me-1"></i>Uploader le document
            </button>
        </div>
        <hr>
       

        <!-- Liste des documents disponibles -->
        <h5><i class="fas fa-files me-2"></i>Documents disponibles</h5>
        <div id="collaborativeDocumentsList" class="mb-4">
            @if(isset($documents) && count($documents) > 0)
                @foreach($documents as $document)
                <div class="document-item d-flex justify-content-between align-items-center p-2 border rounded mb-2">
                    <div>
                        <i class="fas fa-file-word text-primary me-2"></i>
                        <span>{{ $document['name'] }}</span>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-primary me-1" onclick="openWordOnlineEditor({{ $commande->id }}, '{{ $document['name'] }}')">
                            <i class="fas fa-edit me-1"></i>Éditer
                        </button>
                        <a href="{{ $document['url'] }}" class="btn btn-sm btn-secondary me-1" download>
                            <i class="fas fa-download me-1"></i>Télécharger
                        </a>
                        @if(auth()->user()->isAdmin())
                        <button class="btn btn-sm btn-danger" onclick="deleteCollaborativeDocument({{ $commande->id }}, '{{ $document['name'] }}')">
                            <i class="fas fa-trash me-1"></i>Supprimer
                        </button>
                        @endif
                    </div>
                </div>
                @endforeach
            @else
                <p class="text-muted">Aucun document collaboratif disponible.</p>
            @endif
        </div>

        <!-- Éditeur Quill -->
        <h5><i class="fas fa-edit me-2"></i>Éditeur</h5>
        <div class="editor-container border rounded p-2" id="wordOnlineEditor">
            <div class="mb-2 d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">Document: <span id="currentDocName">aucun</span></small>
                </div>
                <div>
                    <button class="btn btn-sm btn-outline-primary" id="btnSaveQuill"><i class="fas fa-save me-1"></i>Enregistrer</button>
                </div>
            </div>
            <div id="quillToolbar"></div>
            <div id="quillEditor"></div>
        </div>
    </div>
</div>

 <div class="remote-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-desktop me-2"></i>Contrôle à Distance</h1>
            <div id="connectionStatus" class="d-flex align-items-center">
                <span class="connection-status status-disconnected"></span>
                <span>Déconnecté</span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card session-card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-user me-2"></i>Demander le contrôle</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="userId" class="form-label">Votre identifiant</label>
                            <input type="text" class="form-control" id="userId" placeholder="Ex: user123">
                        </div>
                        <div class="mb-3">
                            <label for="userName" class="form-label">Votre nom</label>
                            <input type="text" class="form-control" id="userName" placeholder="Ex: John Doe">
                        </div>
                        <div class="mb-3">
                            <label for="targetSessionId" class="form-label">ID de session cible (optionnel)</label>
                            <input type="text" class="form-control" id="targetSessionId" placeholder="Laisser vide pour une nouvelle session">
                        </div>
                        <button id="requestAccessBtn" class="btn btn-primary w-100">
                            <i class="fas fa-hand-paper me-2"></i>Demander l'accès
                        </button>
                    </div>
                </div>

                <div class="card session-card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="fas fa-bell me-2"></i>Demandes entrantes</h5>
                    </div>
                    <div class="card-body">
                        <div id="incomingRequests">
                            <p class="text-muted text-center">Aucune demande pour le moment</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card session-card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-desktop me-2"></i>Session active</h5>
                    </div>
                    <div class="card-body">
                        <div id="activeSession" class="d-none">
                            <div class="remote-screen mb-3" id="remoteScreen">
                                <div class="h-100 d-flex align-items-center justify-content-center text-white">
                                    <div class="text-center">
                                        <i class="fas fa-spinner fa-spin fa-2x mb-2"></i>
                                        <p>Connexion en cours...</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="control-tools mb-3">
                                <h6>Outils de contrôle</h6>
                                <div class="btn-group w-100 mb-2">
                                    <button class="btn btn-outline-secondary" onclick="sendControlCommand('take-screenshot')">
                                        <i class="fas fa-camera"></i> Capture
                                    </button>
                                    <button class="btn btn-outline-secondary" onclick="sendControlCommand('lock-screen')">
                                        <i class="fas fa-lock"></i> Verrouiller
                                    </button>
                                    <button class="btn btn-outline-secondary" onclick="sendControlCommand('open-file')">
                                        <i class="fas fa-folder-open"></i> Fichier
                                    </button>
                                </div>
                                
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" id="customCommand" placeholder="Commande personnalisée">
                                    <button class="btn btn-primary" onclick="executeCustomCommand()">
                                        <i class="fas fa-play"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="d-grid">
                                <button id="endSessionBtn" class="btn btn-danger">
                                    <i class="fas fa-times me-2"></i>Terminer la session
                                </button>
                            </div>
                        </div>
                        
                        <div id="noActiveSession" class="text-center py-4">
                            <i class="fas fa-desktop fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Aucune session active</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
<script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
<script src="https://unpkg.com/quill@1.3.7/dist/quill.min.js"></script>
<script src="{{asset('clients/js-data/remote.js')}}"></script>
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
<script>
// Fonctions pour gérer les documents collaboratifs
function uploadCollaborativeDocument(commandeId) {
    const fileInput = document.getElementById('collaborativeDocUpload');
    const file = fileInput.files[0];
    
    if (!file) {
        alert('Veuillez sélectionner un fichier Word');
        return;
    }
    
    // Vérification du type de fichier
    const allowedTypes = ['.docx', '.doc'];
    const fileExtension = file.name.substring(file.name.lastIndexOf('.')).toLowerCase();
    
    if (!allowedTypes.includes(fileExtension)) {
        alert('Seuls les documents Word (.docx, .doc) sont autorisés');
        return;
    }
    
    // Vérification de la taille du fichier
    if (file.size > 10 * 1024 * 1024) {
        alert('Le fichier ne doit pas dépasser 10MB');
        return;
    }
    
    const formData = new FormData();
    formData.append('document', file);
    
    // Afficher un indicateur de chargement
    const uploadBtn = fileInput.nextElementSibling;
    const originalText = uploadBtn.innerHTML;
    uploadBtn.innerHTML = '<div class="spinner-border spinner-border-sm" role="status"></div> Upload en cours...';
    uploadBtn.disabled = true;
    
    fetch(`/commandes/${commandeId}/collaborative-docs/upload`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(response => {
        // Vérifier d'abord le type de contenu
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            throw new Error('Réponse serveur invalide');
        }
        return response.json();
    })
    .then(data => {
        uploadBtn.innerHTML = originalText;
        uploadBtn.disabled = false;
        
        if (data.success) {
            alert('Document téléchargé avec succès!');
            fileInput.value = '';
            // Recharger les documents
            loadCollaborativeDocuments(commandeId);
        } else {
            alert('Erreur: ' + data.message);
        }
    })
    .catch(error => {
        uploadBtn.innerHTML = originalText;
        uploadBtn.disabled = false;
        console.error('Erreur:', error);
        alert('Une erreur s\'est produite lors du téléchargement. Veuillez réessayer.');
    });
}

function loadCollaborativeDocuments(commandeId) {
    fetch(`/api/commandes/${commandeId}/collaborative-docs`)
    .then(response => {
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            throw new Error('Réponse serveur invalide');
        }
        return response.json();
    })
    .then(data => {
        const container = document.getElementById('collaborativeDocumentsList');
        
        if (data.success && data.documents.length > 0) {
            let html = '';
            data.documents.forEach(document => {
                html += `
                    <div class="document-item d-flex justify-content-between align-items-center p-2 border rounded mb-2">
                        <div>
                            <i class="fas fa-file-word text-primary me-2"></i>
                            <span>${document.name}</span>
                            <small class="text-muted ms-2">(${formatFileSize(document.size)})</small>
                        </div>
                        <div>
                            <button class="btn btn-sm btn-primary me-1" onclick="openWordOnlineEditor(${commandeId}, '${encodeURIComponent(document.name)}')">
                                <i class="fas fa-edit me-1"></i>Éditer
                            </button>
                            <a href="${document.url}" class="btn btn-sm btn-secondary me-1" download>
                                <i class="fas fa-download me-1"></i>Télécharger
                            </a>
                            @if(auth()->user()->isAdmin())
                            <button class="btn btn-sm btn-danger" onclick="deleteCollaborativeDocument(${commandeId}, '${encodeURIComponent(document.name)}')">
                                <i class="fas fa-trash me-1"></i>Supprimer
                            </button>
                            @endif
                        </div>
                    </div>
                `;
            });
            container.innerHTML = html;
        } else {
            container.innerHTML = '<p class="text-muted">Aucun document collaboratif disponible.</p>';
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        document.getElementById('collaborativeDocumentsList').innerHTML = 
            '<p class="text-muted">Erreur lors du chargement des documents.</p>';
    });
}

let quillInstance = null;
let quillInitialized = false;
function ensureQuill() {
    if (quillInitialized) return;
    const toolbarOptions = [
        [{ 'header': [1, 2, 3, false] }],
        ['bold', 'italic', 'underline', 'strike'],
        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
        [{ 'indent': '-1'}, { 'indent': '+1' }],
        [{ 'align': [] }],
        ['link', 'blockquote', 'code-block'],
        ['clean']
    ];
    quillInstance = new Quill('#quillEditor', {
        theme: 'snow',
        modules: { toolbar: toolbarOptions }
    });
    quillInitialized = true;
}

function openWordOnlineEditor(commandeId, documentName) {
    ensureQuill();
    const decodedName = decodeURIComponent(documentName);
    document.getElementById('currentDocName').textContent = decodedName;
    const spinner = `<div class="text-center p-2 text-muted"><div class="spinner-border spinner-border-sm me-2"></div>Chargement...</div>`;
    quillInstance.setContents([]);
    document.getElementById('quillEditor').insertAdjacentHTML('afterbegin', spinner);

    fetch(`/commandes/${commandeId}/collaborative-docs/${documentName}/load-html`)
        .then(r => r.json())
        .then(data => {
            document.querySelector('#quillEditor .spinner-border')?.parentElement?.remove();
            if (data.success) {
                // Charger le HTML dans Quill
                const temp = document.createElement('div');
                temp.innerHTML = data.html || '';
                quillInstance.setText('');
                quillInstance.clipboard.dangerouslyPasteHTML(temp.innerHTML);

                // Brancher le bouton sauvegarder
                const btn = document.getElementById('btnSaveQuill');
                btn.onclick = function() {
                    const html = quillInstance.root.innerHTML;
                    fetch(`/commandes/${commandeId}/collaborative-docs/${documentName}/save-html`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        body: JSON.stringify({ html })
                    }).then(r => r.json()).then(resp => {
                        if (resp.success) {
                            alert('Document enregistré');
                        } else {
                            alert('Erreur: ' + (resp.message || 'Enregistrement'));
                        }
                    }).catch(() => alert('Erreur de connexion'));
                };
            } else {
                alert(data.message || 'Erreur de chargement');
            }
        })
        .catch(() => {
            document.querySelector('#quillEditor .spinner-border')?.parentElement?.remove();
            alert('Erreur de chargement');
        });
}

function deleteCollaborativeDocument(commandeId, documentName) {
    const decodedName = decodeURIComponent(documentName);
    
    if (!confirm(`Êtes-vous sûr de vouloir supprimer le document "${decodedName}"?`)) {
        return;
    }
    
    fetch(`/commandes/${commandeId}/collaborative-docs/${documentName}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            throw new Error('Réponse serveur invalide');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert('Document supprimé avec succès');
            loadCollaborativeDocuments(commandeId);
            closeWordOnlineEditor();
        } else {
            alert('Erreur: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Une erreur s\'est produite lors de la suppression');
    });
}

function closeWordOnlineEditor() {
    const editorContainer = document.getElementById('wordOnlineEditor');
    editorContainer.innerHTML = `
        <div class="text-center p-5 text-muted">
            <i class="fas fa-file-word fa-3x mb-3"></i>
            <h4>Sélectionnez un document à éditer</h4>
            <p>Choisissez un document dans la liste pour commencer l'édition collaborative</p>
        </div>
    `;
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// Charger les documents au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    const commandeId = {{$videoCall->commande->id}};
    loadCollaborativeDocuments(commandeId);
});
</script>
@endsection