
document.addEventListener('DOMContentLoaded', function () {
  $(document).ready(function() {
    let table = $('#projectTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url:'/projects/datatable',
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
        return fullName ;
    }
    return '—';
                }
            },
            { data: 'title', name: 'title' },
            { data: 'problem', name: 'problem' },
           
        
          
            { data: 'budget', name: 'budget' },
            
            { 
                data: 'status', 
                name: 'status',
                render: function(data) {
                    const statusMap = {
                        'pending': 'badge-warning',
                        'pending_signature': 'badge-info',
                        'under_review': 'badge-info',
                        'approved': 'badge-success',
                        'paid': 'badge-info',
                        'rejected': 'badge-danger',
                        'completed': 'badge-secondary'
                    };
                    const statusText = {
                        'pending': 'En attente',
                        'pending_signature': 'Signature',
                        'under_review': 'En vérification',
                        'approved': 'Approuvé',
                        'rejected': 'Rejeté',
                        'completed': 'Terminé',
                        'paid': 'Payé'
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







});