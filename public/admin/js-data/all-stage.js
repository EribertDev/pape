
document.addEventListener('DOMContentLoaded', function () {
  $(document).ready(function() {
    let table = $('#internshipsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url:'/internships/datatable',
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
        let binome = row.binome ? `<br><small>Binôme: ${row.binome}</small>` : '';
        return fullName + binome;
    }
    return '—';
                }
            },
            { data: 'university', name: 'university' },
            { data: 'structure', name: 'structure' },
            {
                data: 'services',
                name: 'services',
                render: function(data) {
                    if (!data) return '—';

                    const toBadges = (arr) => arr
                        .filter(Boolean)
                        .map(s => `<span class="badge badge-primary me-1">${s}</span>`)
                        .join('');

                    if (Array.isArray(data)) {
                        return toBadges(data);
                    }
                    // au cas où ce soit une chaîne JSON côté API
                    try {
                        const parsed = JSON.parse(data);
                        if (Array.isArray(parsed)) return toBadges(parsed);
                    } catch (e) {}
                    // sinon, afficher en badge unique
                    return `<span class="badge badge-primary style="text-wrap: wrap;text-color: white;">${String(data)}</span>`;
                }
            },
            {
                data: 'admin_culture_training',
                name: 'admin_culture_training',
                render: function(data) {
                    if (data === true || data === '1' || data === 1 || data === 'oui') {
                        return '<span class="badge bg-success">Oui</span>';
                    }
                    if (data === false || data === '0' || data === 0 || data === 'non' || data == null) {
                        return '<span class="badge bg-secondary">Non</span>';
                    }
                    return `<span class="badge bg-secondary">${data}</span>`;
                }
            },
            { 
                data: 'specialite', name: 'specialite',
            },
        
          
            { data: 'duration', name: 'duration' },
            { data: 'commune', name: 'commune' },
            { 
                data: 'status', 
                name: 'status',
                render: function(data) {
                    const statusMap = {
                        'pending': 'badge-warning',
                        'pending_signature': 'badge-info',
                        'under_review': 'badge-info',
                        'approved': 'badge-success',
                        'rejected': 'badge-danger',
                        'completed': 'badge-secondary'
                    };
                    const statusText = {
                        'pending': 'En attente',
                        'pending_signature': 'Signature',
                        'under_review': 'En vérification',
                        'approved': 'Approuvé',
                        'rejected': 'Rejeté',
                        'completed': 'Terminé'
                    };
                    return `<span class="badge ${statusMap[data]}">${statusText[data]}</span>`;
                }
            },
            { 
                data: 'created_at', 
                name: 'created_at',
                render: function(data) {
                    return new Date(data).toLocaleDateString();
                }
            },
            {
                data: 'id',
                name: 'actions',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    let buttons = `
                        <button class=" mr-3 btn btn-sm btn-info view-btn"  title="Voir détails">
                            <i class="ti-eye"></i> <a  href="${row.details}">Detail </a>
                        </button>`;
                    
                    if (row.status === 'pending_signature') {
                        buttons += `
                        <button class="btn btn-sm btn-warning upload-btn" data-id="${data}" title="Upload contrat signé">
                            <i class="ti-upload"> </i>
                        </button>`;
                    }
                    
                    if (row.signed_contract_path) {
                        buttons += `
                        <a href="${row.download_url}" class="btn btn-sm btn-primary" title="Télécharger contrat signé">
                            <i class="ti-download"></i>Contrat signé
                        </a>`;
                    }
                    
                    return `<div class="btn-group">${buttons}</div>`;
                }
            }
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
        },
        responsive: true
    });
});






// Gestion du bouton "Upload contrat signé"
$(document).on('click', '.upload-btn', function() {
    const requestId = $(this).data('id');
    
    $('#uploadRequestId').val(requestId);
    $('#uploadModal').modal('show');
});
});