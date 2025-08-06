document.addEventListener('DOMContentLoaded', function () {
  $(document).ready(function() {
    let table = $('#reprographyTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/reprography/datatable',
            type: "GET"
        },
        columns: [
            { data: 'id', name: 'id' },
            { 
                data: 'user.client.fist_name', 
                name: 'user.client.fist_name',
                render: function(data, type, row) {
                  if (row.user && row.user.client) {
        let fullName = `${row.user.client.fist_name} ${row.user.client.last_name}`;
        let contact=row.user.client.phone_number? `<br><small>Contact: ${row.user.client.phone_number}</small>` : '';
        return fullName + contact;
    }
    return '—';
                }
            },
            { 
                data: 'service_types', 
                name: 'service_types',
                render: function(data, type, row) {
                    if (!data) return '—';
                    
                    // Vérification si data est déjà un tableau
                    let services = Array.isArray(data) ? data : [];
                    
                    // Si c'est une chaîne, essayer de la parser
                    if (typeof data === 'string') {
                        try {
                            services = JSON.parse(data);
                        } catch (e) {
                            console.error('Erreur de parsing JSON:', e);
                            return 'Format invalide';
                        }
                    }
                    
                    let badges = '';
                    services.forEach(service => {
                        const serviceNames = {
                            'impression': 'Impression',
                            'photocopie': 'Photocopie',
                            'saisie_texte': 'Saisie texte',
                            'tirage_photo': 'Tirage photo',
                            'carte_visite': 'Carte visite',
                            'affiche': 'Affiche',
                            'flyers': 'Flyers'
                        };
                        badges += `<span class="badge bg-primary me-1">${serviceNames[service] || service}</span>`;
                    });
                    return badges || '—';
                }
            },
            { 
                data: 'page_count', 
                name: 'page_count',
                render: function(data, type, row) {
                    const pages = data || 0;
                    const copies = row.copy_count || 0;
                    return `${pages} pages × ${copies} ex.`;
                }
            },
            { 
                data: 'total_cost', 
                name: 'total_cost',
                render: function(data) {
                    return data ? `${Number(data).toLocaleString('fr-FR')} FCFA` : '—';
                }
            },
            { 
                data: 'status', 
                name: 'status',
                render: function(data) {
                    const statusMap = {
                        'pending': 'bg-warning',
                        'processing': 'bg-info',
                        'completed': 'bg-success',
                        'cancelled': 'bg-danger'
                    };
                    const statusText = {
                        'pending': 'En attente',
                        'processing': 'En traitement',
                        'completed': 'Terminée',
                        'cancelled': 'Annulée'
                    };
                    return data ? `<span class="badge ${statusMap[data] || 'bg-secondary'}">${statusText[data] || data}</span>` : '—';
                }
            },
            { 
                data: 'created_at', 
                name: 'created_at',
                render: function(data) {
                    if (!data) return '—';
                    try {
                        const date = new Date(data);
                        return date.toLocaleDateString('fr-FR', {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    } catch (e) {
                        return data;
                    }
                }
            },
            {
                data: 'id',
                name: 'actions',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    let buttons = `
                        <a href="/admin/reprography/details/${data}" class="btn btn-sm btn-info me-2" title="Voir détails">
                            <i class="fas fa-eye"></i>
                        </a>`;
                    
                    if (row.status === 'pending') {
                        buttons += `
                        <button class="btn btn-sm btn-success accept-btn me-2" data-id="${data}" title="Accepter">
                            <i class="fas fa-check"></i>
                        </button>
                        <button class="btn btn-sm btn-danger reject-btn" data-id="${data}" title="Rejeter">
                            <i class="fas fa-times"></i>
                        </button>`;
                    }
                    
                    if (row.status === 'processing') {
                        buttons += `
                        <button class="btn btn-sm btn-primary complete-btn" data-id="${data}" title="Marquer comme terminée">
                            <i class="fas fa-check-double"></i>
                        </button>`;
                    }
                    
                    return `<div class="d-flex">${buttons}</div>`;
                }
            }
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
        },
        responsive: true,
        order: [[0, 'desc']],
        error: function(xhr, error, thrown) {
            console.error('Erreur DataTables:', xhr, error, thrown);
            // Vous pouvez afficher un message d'erreur à l'utilisateur ici
        }
    });

    // Gestion du bouton "Accepter"
    $(document).on('click', '.accept-btn', function() {
        const orderId = $(this).data('id');
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
                $.ajax({
                    url: `/admin/reprography/${orderId}/accept`,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        Swal.showLoading();
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Succès',
                                text: response.message,
                                confirmButtonColor: '#2eca7f'
                            }).then(() => {
                                table.ajax.reload(null, false);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erreur',
                                text: response.message || 'Action échouée'
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur',
                            text: xhr.responseJSON?.message || 'Une erreur est survenue'
                        });
                    }
                });
            }
        });
    });

    // Gestion du bouton "Rejeter"
    $(document).on('click', '.reject-btn', function() {
        const orderId = $(this).data('id');
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
            inputValidator: (value) => {
                if (!value) {
                    return 'Veuillez indiquer une raison';
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/reprography/${orderId}/reject`,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        reason: result.value
                    },
                    beforeSend: function() {
                        Swal.showLoading();
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Succès',
                                text: response.message,
                                confirmButtonColor: '#2eca7f'
                            }).then(() => {
                                table.ajax.reload(null, false);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erreur',
                                text: response.message || 'Action échouée'
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur',
                            text: xhr.responseJSON?.message || 'Une erreur est survenue'
                        });
                    }
                });
            }
        });
    });

    // Gestion du bouton "Marquer comme terminée"
    $(document).on('click', '.complete-btn', function() {
        const orderId = $(this).data('id');
        Swal.fire({
            title: 'Terminer la commande',
            text: "Voulez-vous marquer cette commande comme terminée ?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2eca7f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, terminer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/reprography/${orderId}/complete`,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        Swal.showLoading();
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Succès',
                                text: response.message,
                                confirmButtonColor: '#2eca7f'
                            }).then(() => {
                                table.ajax.reload(null, false);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erreur',
                                text: response.message || 'Action échouée'
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur',
                            text: xhr.responseJSON?.message || 'Une erreur est survenue'
                        });
                    }
                });
            }
        });
    });
});
});