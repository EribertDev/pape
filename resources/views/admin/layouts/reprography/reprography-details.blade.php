@extends('admin.master')
@section('extra-style')
<style>
    :root {
        --primary-color: #2eca7f;
        --primary-light: #e6f9f2;
        --primary-dark: #24a86a;
        --secondary-color: #1d4ed8;
    }
    
    .card {
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        border: none;
        margin-bottom: 20px;
        transition: transform 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        border-radius: 12px 12px 0 0 !important;
        padding: 15px 20px;
        border-bottom: none;
    }
    
    .card-body {
        padding: 20px;
    }
    
    .badge {
        padding: 8px 12px;
        border-radius: 20px;
        font-weight: 500;
    }
    
    .badge-pending {
        background-color: #ffc107;
        color: #343a40;
    }
    
    .badge-processing {
        background-color: #17a2b8;
        color: white;
    }
    
    .badge-completed {
        background-color: #28a745;
        color: white;
    }
    
    .badge-cancelled {
        background-color: #dc3545;
        color: white;
    }
    
    .download-btn {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 8px;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    
    .download-btn:hover {
        background-color: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(46, 202, 127, 0.3);
    }
    
    .download-btn i {
        font-size: 0.9rem;
    }
    
    .service-tag {
        display: inline-block;
        background-color: var(--primary-light);
        color: var(--primary-dark);
        padding: 5px 12px;
        border-radius: 20px;
        margin-right: 5px;
        margin-bottom: 5px;
        font-size: 0.85rem;
    }
    
    .cost-badge {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        padding: 8px 15px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    .file-info-card {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
        border-left: 4px solid var(--primary-color);
    }
    
    .status-indicator {
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-right: 8px;
    }
    
    .status-pending {
        background-color: #ffc107;
    }
    
    .status-processing {
        background-color: #17a2b8;
    }
    
    .status-completed {
        background-color: #28a745;
    }
    
    .status-cancelled {
        background-color: #dc3545;
    }
    
    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 8px 15px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .btn-accept {
        background-color: var(--primary-color);
        color: white;
    }
    
    .btn-accept:hover {
        background-color: var(--primary-dark);
    }
    
    .btn-reject {
        background-color: #dc3545;
        color: white;
    }
    
    .btn-reject:hover {
        background-color: #bd2130;
    }
    
    .btn-print {
        background-color: #6c757d;
        color: white;
    }
    
    .btn-print:hover {
        background-color: #5a6268;
    }
    
    .detail-row {
        padding: 12px 0;
        border-bottom: 1px solid #eee;
    }
    
    .detail-row:last-child {
        border-bottom: none;
    }
    
    .detail-label {
        font-weight: 600;
        color: #495057;
        min-width: 180px;
    }
    
    .detail-value {
        color: #343a40;
    }
    
    .timeline {
        position: relative;
        padding-left: 30px;
        margin-top: 20px;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        left: 10px;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: #e9ecef;
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 20px;
    }
    
    .timeline-item::before {
        content: '';
        position: absolute;
        left: -25px;
        top: 5px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background-color: var(--primary-color);
        border: 3px solid white;
    }
    
    .timeline-date {
        font-size: 0.85rem;
        color: #6c757d;
    }
    
    .timeline-content {
        background-color: white;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }
</style>
@endsection

@section('page-content')
<div class="content">
    <div class="container-fluid">
        <!-- En-tête avec ID de commande et boutons d'action -->
        <div class="row mb-4">
            <div class="col-md-9">
                <h4 class="page-title">Commande de reprographie #{{ $order->id }}</h4>
                <p class="text-muted mb-0">Détails de la commande de reprographie</p>
            </div>
            <div class="col-md-3 text-end">
                <div class="d-flex justify-content-end gap-2">
                    @if($order->status === 'pending')
                        <button class="action-btn btn-accept" id="acceptBtn">
                            <i class="fas fa-check-circle"></i> Accepter
                        </button>
                        <button class="action-btn btn-reject" id="rejectBtn">
                            <i class="fas fa-times-circle"></i> Rejeter
                        </button>
                    @endif
                    <button class="action-btn btn-print" id="printBtn">
                        <i class="fas fa-print"></i> Imprimer
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Colonne gauche - Détails de la commande -->
            <div class="col-lg-8">
                <!-- Carte des détails de la commande -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Détails de la commande</h5>
                    </div>
                    <div class="card-body">
                        <div class="detail-row d-flex">
                            <div class="detail-label">ID de commande</div>
                            <div class="detail-value">#{{ $order->id }}</div>
                        </div>
                        <div class="detail-row d-flex">
                            <div class="detail-label">Client</div>
                            <div class="detail-value">{{ $order->user->client->fist_name }} {{ $order->user->client->last_name }}</div>
                        </div>
                        <div class="detail-row d-flex">
                            <div class="detail-label">Contact</div>
                            <div class="detail-value">{{ $order->user->client->phone_number }}</div>
                        </div>
                        <div class="detail-row d-flex">
                            <div class="detail-label">Date de création</div>
                            <div class="detail-value">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                        <div class="detail-row d-flex">
                            <div class="detail-label">Statut</div>
                            <div class="detail-value">
                                @if($order->status === 'pending')
                                    <span class="badge badge-pending">
                                        <span class="status-indicator status-pending"></span>
                                        En attente
                                    </span>
                                @elseif($order->status === 'processing')
                                    <span class="badge badge-processing">
                                        <span class="status-indicator status-processing"></span>
                                        En cours de traitement
                                    </span>
                                @elseif($order->status === 'completed')
                                    <span class="badge badge-completed">
                                        <span class="status-indicator status-completed"></span>
                                        Terminée
                                    </span>
                                @elseif($order->status === 'cancelled')
                                    <span class="badge badge-cancelled">
                                        <span class="status-indicator status-cancelled"></span>
                                        Annulée
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="detail-row d-flex">
                            <div class="detail-label">Services demandés</div>
                            <div class="detail-value">
                               @foreach((array)$order->service_types as $service)
                                <span class="service-tag">
                                    @if($service === 'impression') Impression @endif
                                    @if($service === 'photocopie') Photocopie @endif
                                    @if($service === 'saisie_texte') Saisie de texte @endif
                                    @if($service === 'tirage_photo') Tirage photo @endif
                                    @if($service === 'carte_visite') Carte de visite @endif
                                    @if($service === 'affiche') Affiche @endif
                                    @if($service === 'flyers') Flyers @endif
                                </span>
                            @endforeach
                            </div>
                        </div>
                        <div class="detail-row d-flex">
                            <div class="detail-label">Options</div>
                            <div class="detail-value">
                                <div>Couleur: {{ $order->color === 'couleur' ? 'Couleur' : 'Noir et blanc' }}</div>
                                <div>Impression: {{ $order->option }}</div>
                                <div>Format: {{ $order->format }}</div>
                                <div>Reliure: {{ $order->binding ? 'Oui' : 'Non' }}</div>
                                <div>Plastification: {{ $order->lamination ? 'Oui' : 'Non' }}</div>
                            </div>
                        </div>
                        <div class="detail-row d-flex">
                            <div class="detail-label">Quantité</div>
                            <div class="detail-value">
                                <div>Pages: {{ $order->page_count }}</div>
                                <div>Exemplaires: {{ $order->copy_count }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carte des détails de livraison -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Détails de livraison</h5>
                    </div>
                    <div class="card-body">
                        <div class="detail-row d-flex">
                            <div class="detail-label">Mode de livraison</div>
                            <div class="detail-value">{{ $order->delivery_mode === 'Domicile' ? 'Livraison à domicile' : 'Point relais' }}</div>
                        </div>
                        <div class="detail-row d-flex">
                            <div class="detail-label">Commune</div>
                            <div class="detail-value">{{ $order->commune }}</div>
                        </div>
                        <div class="detail-row d-flex">
                            <div class="detail-label">Quartier</div>
                            <div class="detail-value">{{ $order->neighborhood }}</div>
                        </div>
                        <div class="detail-row d-flex">
                            <div class="detail-label">Adresse</div>
                            <div class="detail-value">{{ $order->address_details }}</div>
                        </div>
                        <div class="detail-row d-flex">
                            <div class="detail-label">Localisation GPS</div>
                            <div class="detail-value">{{ $order->gps_location ?? 'Non spécifiée' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Carte du fichier source -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Fichier source</h5>
                    </div>
                    <div class="card-body">
                        <div class="file-info-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Fichier Commande {{ $order->id }}</h6>
                                </div>
                                <a href="{{ route('download.reprography_file', $order->id) }}" class="download-btn">
                                    <i class="fas fa-download"></i> Télécharger
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Colonne droite - Coût et historique -->
            <div class="col-lg-4">
                <!-- Carte des coûts -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Coût de la commande</h5>
                    </div>
                    <div class="card-body">
                        <div class="detail-row d-flex justify-content-between">
                            <div>Coût de la commande:</div>
                            <div class="cost-badge">{{ number_format($order->order_cost, 0, ',', ' ') }} FCFA</div>
                        </div>
                        <div class="detail-row d-flex justify-content-between">
                            <div>Coût de livraison:</div>
                            <div class="cost-badge">{{ number_format($order->delivery_cost, 0, ',', ' ') }} FCFA</div>
                        </div>
                        <div class="detail-row d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                            <div class="fw-bold">Total:</div>
                            <div class="cost-badge" style="font-size: 1.3rem;">{{ number_format($order->total_cost, 0, ',', ' ') }} FCFA</div>
                        </div>
                        <div class="mt-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="studentTariff" 
                                    {{ $order->student_tariff ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="studentTariff">Tarif étudiant appliqué</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carte d'historique -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Historique de la commande</h5>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-date">Création: {{ $order->created_at->format('d/m/Y H:i') }}</div>
                                <div class="timeline-content">
                                    Commande créée par le client
                                </div>
                            </div>
                            
                            @if($order->status_updated_at)
                            <div class="timeline-item">
                                <div class="timeline-date">Mise à jour: {{ $order->status_updated_at->format('d/m/Y H:i') }}</div>
                                <div class="timeline-content">
                                    Statut changé à 
                                    @if($order->status === 'processing')
                                        <span class="badge badge-processing">En cours de traitement</span>
                                    @elseif($order->status === 'completed')
                                        <span class="badge badge-completed">Terminée</span>
                                    @elseif($order->status === 'cancelled')
                                        <span class="badge badge-cancelled">Annulée</span>
                                    @endif
                                </div>
                            </div>
                            @endif
                            
                            @if($order->processing_started_at)
                            <div class="timeline-item">
                                <div class="timeline-date">Traitement: {{ $order->processing_started_at->format('d/m/Y H:i') }}</div>
                                <div class="timeline-content">
                                    Commande en cours de traitement
                                </div>
                            </div>
                            @endif
                            
                            @if($order->completed_at)
                            <div class="timeline-item">
                                <div class="timeline-date">Terminé: {{ $order->completed_at->format('d/m/Y H:i') }}</div>
                                <div class="timeline-content">
                                    Commande terminée et prête pour livraison
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Carte d'actions -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Actions</h5>
                    </div>
                    <div class="card-body">
                        @if($order->status === 'pending' || $order->status === 'processing')
                            <button class="btn btn-primary w-100 mb-2">
                                <i class="fas fa-edit me-2"></i> Modifier la commande
                            </button>
                        @endif
                        
                        @if($order->status === 'processing')
                            <button class="btn btn-success w-100 mb-2" id="markCompletedBtn">
                                <i class="fas fa-check-circle me-2"></i> Marquer comme terminée
                            </button>
                        @endif
                        
                        @if($order->status !== 'cancelled' && $order->status !== 'completed')
                            <button class="btn btn-danger w-100 mb-2" id="cancelOrderBtn">
                                <i class="fas fa-times-circle me-2"></i> Annuler la commande
                            </button>
                        @endif
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Gestion du bouton d'acceptation
        $('#acceptBtn').click(function() {
            Swal.fire({
                title: 'Accepter la commande',
                text: "Voulez-vous vraiment accepter cette commande ?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2eca7f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, accepter',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Envoyer la requête AJAX pour accepter la commande
                    $.ajax({
                        url:'/admin/reprography/{{ $order->id }}/accept',
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        beforeSend: function() {
                            Swal.showLoading();
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Commande acceptée',
                                    text: response.message,
                                    confirmButtonColor: '#2eca7f'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erreur',
                                    text: response.message
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erreur',
                                text: 'Une erreur est survenue lors de l\'acceptation de la commande'
                            });
                        }
                    });
                }
            });
        });

        // Gestion du bouton de rejet
        $('#rejectBtn').click(function() {
            Swal.fire({
                title: 'Rejeter la commande',
                text: "Voulez-vous vraiment rejeter cette commande ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, rejeter',
                cancelButtonText: 'Annuler',
                input: 'textarea',
                inputPlaceholder: 'Raison du rejet...',
                inputAttributes: {
                    'aria-label': 'Raison du rejet'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const reason = result.value || 'Aucune raison spécifiée';
                    
                    // Envoyer la requête AJAX pour rejeter la commande
                    $.ajax({
                        url: '/admin/reprography/{{ $order->id }}/reject',
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            reason: reason
                        },
                        beforeSend: function() {
                            Swal.showLoading();
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Commande rejetée',
                                    text: response.message,
                                    confirmButtonColor: '#2eca7f'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erreur',
                                    text: response.message
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erreur',
                                text: 'Une erreur est survenue lors du rejet de la commande'
                            });
                        }
                    });
                }
            });
        });

        // Gestion du bouton de marquage comme terminée
        $('#markCompletedBtn').click(function() {
            Swal.fire({
                title: 'Commande terminée',
                text: "Voulez-vous marquer cette commande comme terminée ?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2eca7f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, terminer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Envoyer la requête AJAX
                    $.ajax({
                        url: '/admin/reprography/{{ $order->id }}/complete',
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        beforeSend: function() {
                            Swal.showLoading();
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Commande terminée',
                                    text: response.message,
                                    confirmButtonColor: '#2eca7f'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erreur',
                                    text: response.message
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erreur',
                                text: 'Une erreur est survenue lors de la mise à jour'
                            });
                        }
                    });
                }
            });
        });

        // Gestion du bouton d'annulation
        $('#cancelOrderBtn').click(function() {
            Swal.fire({
                title: 'Annuler la commande',
                text: "Voulez-vous vraiment annuler cette commande ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, annuler',
                cancelButtonText: 'Annuler',
                input: 'textarea',
                inputPlaceholder: 'Raison de l\'annulation...',
                inputAttributes: {
                    'aria-label': 'Raison de l\'annulation'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const reason = result.value || 'Aucune raison spécifiée';
                    
                    // Envoyer la requête AJAX
                    $.ajax({
                        url: '/admin/reprography/{{ $order->id }}/cancel',
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            reason: reason
                        },
                        beforeSend: function() {
                            Swal.showLoading();
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Commande annulée',
                                    text: response.message,
                                    confirmButtonColor: '#2eca7f'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erreur',
                                    text: response.message
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erreur',
                                text: 'Une erreur est survenue lors de l\'annulation'
                            });
                        }
                    });
                }
            });
        });

        // Gestion du bouton d'impression
        $('#printBtn').click(function() {
            Swal.fire({
                title: 'Imprimer les détails',
                text: "Voulez-vous imprimer les détails de cette commande ?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2eca7f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, imprimer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.print();
                }
            });
        });
    });
</script>
@endsection