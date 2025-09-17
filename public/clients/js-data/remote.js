class RemoteAccess {
    constructor() {
        this.peerConnection = null;
        this.dataChannel = null;
        this.currentSessionId = null;
        this.isControlling = false;
        this.isSharing = false;
        this.pendingRequests = [];
        
        this.initializeEventListeners();
        this.startRequestPolling();
    }

    initializeEventListeners() {
        // Demander l'accès
        document.getElementById('requestAccessBtn').addEventListener('click', () => {
            this.requestAccess();
        });

        // Terminer la session
        document.getElementById('endSessionBtn').addEventListener('click', () => {
            this.endSession();
        });
    }

    async requestAccess() {
        const userId = document.getElementById('userId').value;
        const userName = document.getElementById('userName').value;
        const targetSessionId = document.getElementById('targetSessionId').value;

        if (!userId || !userName) {
            this.showNotification('Veuillez remplir tous les champs', 'error');
            return;
        }

        try {
            let sessionId = targetSessionId;
            
            if (!sessionId) {
                // Créer une nouvelle session
                const response = await fetch('/api/remote-access/session', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.getCsrfToken()
                    },
                    body: JSON.stringify({
                        user_id: userId,
                        user_name: userName
                    })
                });

                const data = await response.json();
                
                if (data.success) {
                    sessionId = data.session_id;
                    this.showNotification('Session créée. En attente de réponse...', 'info');
                } else {
                    throw new Error(data.message);
                }
            }

            this.currentSessionId = sessionId;
            this.monitorSessionStatus(sessionId);
            
        } catch (error) {
            console.error('Erreur demande accès:', error);
            this.showNotification('Erreur lors de la demande: ' + error.message, 'error');
        }
    }

    async monitorSessionStatus(sessionId) {
        const checkStatus = async () => {
            try {
                const response = await fetch(`/api/remote-access/session/${sessionId}/status`);
                const data = await response.json();
                
                if (data.success) {
                    switch (data.session.status) {
                        case 'accepted':
                            this.showNotification('Demande acceptée! Connexion en cours...', 'success');
                            this.initializeWebRTC(sessionId);
                            clearInterval(statusInterval);
                            break;
                        case 'rejected':
                            this.showNotification('Demande refusée', 'error');
                            clearInterval(statusInterval);
                            break;
                        case 'ended':
                            this.showNotification('Session terminée', 'info');
                            clearInterval(statusInterval);
                            break;
                        // pending: on continue à vérifier
                    }
                }
            } catch (error) {
                console.error('Erreur vérification statut:', error);
            }
        };
        
        const statusInterval = setInterval(checkStatus, 2000);
        checkStatus(); // Vérifier immédiatement
    }

    async initializeWebRTC(sessionId) {
        try {
            // Configuration WebRTC
            const configuration = {
                iceServers: [
                    { urls: 'stun:stun.l.google.com:19302' },
                    { urls: 'stun:stun1.l.google.com:19302' }
                ]
            };
            
            this.peerConnection = new RTCPeerConnection(configuration);
            
            // Gérer les candidats ICE
            this.peerConnection.onicecandidate = (event) => {
                if (event.candidate) {
                    this.sendSignal(sessionId, {
                        type: 'ice-candidate',
                        signal: event.candidate
                    });
                }
            };
            
            // Créer un canal de données pour les commandes
            this.dataChannel = this.peerConnection.createDataChannel('remoteControl');
            this.setupDataChannel();
            
            // Créer une offre
            const offer = await this.peerConnection.createOffer();
            await this.peerConnection.setLocalDescription(offer);
            
            // Envoyer l'offre
            this.sendSignal(sessionId, {
                type: 'offer',
                signal: offer
            });
            
            this.isControlling = true;
            this.updateUI();
            
        } catch (error) {
            console.error('Erreur initialisation WebRTC:', error);
            this.showNotification('Erreur de connexion', 'error');
        }
    }

    setupDataChannel() {
        this.dataChannel.onopen = () => {
            console.log('Canal de données ouvert');
            this.updateConnectionStatus('connected');
        };
        
        this.dataChannel.onclose = () => {
            console.log('Canal de données fermé');
            this.updateConnectionStatus('disconnected');
        };
        
        this.dataChannel.onmessage = (event) => {
            this.handleRemoteMessage(event.data);
        };
    }

    async handleRemoteMessage(message) {
        try {
            const command = JSON.parse(message);
            
            switch (command.type) {
                case 'screen-data':
                    this.updateRemoteScreen(command.data);
                    break;
                case 'status-update':
                    this.showNotification(command.message, 'info');
                    break;
                case 'error':
                    this.showNotification(command.message, 'error');
                    break;
                default:
                    console.log('Message reçu:', command);
            }
        } catch (error) {
            console.error('Erreur traitement message:', error);
        }
    }

    async sendSignal(sessionId, signal) {
        try {
            await fetch('/remote-access/signal', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.getCsrfToken()
                },
                body: JSON.stringify({
                    session_id: sessionId,
                    ...signal
                })
            });
        } catch (error) {
            console.error('Erreur envoi signal:', error);
        }
    }

    async checkForSignals(sessionId) {
        try {
            const response = await fetch(`/remote-access/session/${sessionId}`);
            const data = await response.json();
            
            if (data.success) {
                for (const signal of data.signals) {
                    await this.handleIncomingSignal(signal);
                }
            }
        } catch (error) {
            console.error('Erreur vérification signaux:', error);
        }
    }

    async handleIncomingSignal(signal) {
        if (!this.peerConnection) return;
        
        try {
            switch (signal.type) {
                case 'offer':
                    await this.peerConnection.setRemoteDescription(signal.signal);
                    const answer = await this.peerConnection.createAnswer();
                    await this.peerConnection.setLocalDescription(answer);
                    await this.sendSignal(this.currentSessionId, {
                        type: 'answer',
                        signal: answer
                    });
                    break;
                    
                case 'answer':
                    await this.peerConnection.setRemoteDescription(signal.signal);
                    break;
                    
                case 'ice-candidate':
                    await this.peerConnection.addIceCandidate(signal.signal);
                    break;
            }
        } catch (error) {
            console.error('Erreur traitement signal:', error);
        }
    }

    async startRequestPolling() {
        // Vérifier périodiquement les demandes entrantes
        setInterval(async () => {
            try {
                // Cette partie dépend de votre implémentation backend
                // Pour l'exemple, nous allons simplement vérifier les sessions en attente
                // où l'utilisateur courant est la cible
                
                // Dans une implémentation réelle, vous auriez un endpoint API pour récupérer
                // les demandes ciblant l'utilisateur courant
                this.updateIncomingRequests([]);
            } catch (error) {
                console.error('Erreur vérification demandes:', error);
            }
        }, 3000);
    }

    updateIncomingRequests(requests) {
        const container = document.getElementById('incomingRequests');
        
        if (requests.length === 0) {
            container.innerHTML = '<p class="text-muted text-center">Aucune demande pour le moment</p>';
            return;
        }
        
        let html = '';
        requests.forEach(request => {
            html += `
                <div class="card mb-2">
                    <div class="card-body">
                        <h6>${request.requester.name}</h6>
                        <p class="small text-muted">Session: ${request.id}</p>
                        <div class="d-flex">
                            <button class="btn btn-sm btn-success me-1" onclick="remoteAccess.acceptRequest('${request.id}')">
                                <i class="fas fa-check"></i> Accepter
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="remoteAccess.rejectRequest('${request.id}')">
                                <i class="fas fa-times"></i> Refuser
                            </button>
                        </div>
                    </div>
                </div>
            `;
        });
        
        container.innerHTML = html;
    }

    async acceptRequest(sessionId) {
        try {
            const userId = document.getElementById('userId').value || 'user_' + Math.random().toString(36).substr(2, 9);
            const userName = document.getElementById('userName').value || 'Utilisateur';
            
            const response = await fetch(`/api/remote-access/session/${sessionId}/response`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.getCsrfToken()
                },
                body: JSON.stringify({
                    response: 'accepted',
                    user_id: userId,
                    user_name: userName
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.showNotification('Demande acceptée', 'success');
                this.currentSessionId = sessionId;
                this.initializeWebRTC(sessionId);
            } else {
                throw new Error(data.message);
            }
        } catch (error) {
            console.error('Erreur acceptation demande:', error);
            this.showNotification('Erreur: ' + error.message, 'error');
        }
    }

    async rejectRequest(sessionId) {
        try {
            const userId = document.getElementById('userId').value || 'user_' + Math.random().toString(36).substr(2, 9);
            const userName = document.getElementById('userName').value || 'Utilisateur';
            
            const response = await fetch(`/api/remote-access/session/${sessionId}/response`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.getCsrfToken()
                },
                body: JSON.stringify({
                    response: 'rejected',
                    user_id: userId,
                    user_name: userName
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.showNotification('Demande refusée', 'info');
            } else {
                throw new Error(data.message);
            }
        } catch (error) {
            console.error('Erreur rejet demande:', error);
            this.showNotification('Erreur: ' + error.message, 'error');
        }
    }

    async endSession() {
        if (this.currentSessionId) {
            try {
                await fetch(`/api/remote-access/session/${this.currentSessionId}/end`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.getCsrfToken()
                    }
                });
            } catch (error) {
                console.error('Erreur fin de session:', error);
            }
        }
        
        if (this.dataChannel) {
            this.dataChannel.close();
        }
        
        if (this.peerConnection) {
            this.peerConnection.close();
        }
        
        this.isControlling = false;
        this.isSharing = false;
        this.currentSessionId = null;
        this.updateUI();
        this.updateConnectionStatus('disconnected');
        
        this.showNotification('Session terminée', 'info');
    }

    sendControlCommand(command, parameters = {}) {
        if (this.dataChannel && this.dataChannel.readyState === 'open') {
            this.dataChannel.send(JSON.stringify({
                type: 'control-command',
                command: command,
                parameters: parameters,
                timestamp: Date.now()
            }));
        }
    }

    executeCustomCommand() {
        const command = document.getElementById('customCommand').value;
        if (command) {
            this.sendControlCommand('custom', { command: command });
            document.getElementById('customCommand').value = '';
        }
    }

    updateRemoteScreen(data) {
        const screenElement = document.getElementById('remoteScreen');
        // Implémenter l'affichage des données d'écran
        // Cela dépendra de la façon dont vous envoyez les données d'écran
    }

    updateUI() {
        const activeSession = document.getElementById('activeSession');
        const noActiveSession = document.getElementById('noActiveSession');
        
        if (this.isControlling || this.isSharing) {
            activeSession.classList.remove('d-none');
            noActiveSession.classList.add('d-none');
        } else {
            activeSession.classList.add('d-none');
            noActiveSession.classList.remove('d-none');
        }
    }

    updateConnectionStatus(status) {
        const statusElement = document.getElementById('connectionStatus');
        const statusDot = statusElement.querySelector('.connection-status');
        const statusText = statusElement.querySelector('span:last-child');
        
        statusDot.className = 'connection-status status-' + status;
        
        switch (status) {
            case 'connected':
                statusText.textContent = 'Connecté';
                break;
            case 'disconnected':
                statusText.textContent = 'Déconnecté';
                break;
            case 'connecting':
                statusText.textContent = 'Connexion en cours...';
                break;
        }
    }

    showNotification(message, type = 'info') {
        // Implémenter un système de notifications
        // Pour l'exemple, nous utilisons alert
        alert(`${type.toUpperCase()}: ${message}`);
    }

    getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.content || '';
    }
}

// Initialiser l'application
const remoteAccess = new RemoteAccess();