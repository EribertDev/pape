import {getBadgeHtml} from "../../stdev/js/badgeHtml.js";
import {extractDateTime} from "../../stdev/js/date.js";
import {hideElement} from "../../stdev/js/StdeUsefulFunction.js";


document.addEventListener("DOMContentLoaded",function (){
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let newCommandeTable = $('#newCommandeTable').DataTable({
        pagingType: 'full_numbers',
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        columnDefs: [
            { className: "", targets: "_all" }
        ],
        initComplete: function(settings, json) {
            // Personnalisation supplémentaire si nécessaire
        },
        ajax: {
            url: '/admin/commande/all/new', // URL de votre API
            dataSrc: function (json) {
                return json.map(function(item) {
                    return [
                        '', // Colonne pour les checkboxes (remplie plus tard)
                        item.client.fist_name + " " + item.client.last_name,
                        item.service.name,
                        item.structure_stage,
                        extractDateTime(item.deadline,"DD-MM-YYYY").date,
                        extractDateTime(item.created_at,"DD-MM-YYYY","HH:mm").date + " à " + extractDateTime(item.created_at,"DD-MM-YYYY","HH:mm").time,
                        item.status.name,
                        item.uuid,
                    ];
                });
            }
        },
        columns: [
            {
                title: `<label class="form-check-label">
                            <input class="form-check-input select-row" id="select-all" type="checkbox" >
                            <span class="form-check-sign"></span>
                        </label>`, // Checkbox dans le header pour tout sélectionner
                data: null,
                defaultContent: '',
                orderable: false,
                className: 'select-checkbox',
                render: function(data, type, row) {
                    return `

                        <label class="form-check-label">
                            <input class="form-check-input select-row" type="checkbox" value="" data-uuid="${row[7]}">
                            <span class="form-check-sign"></span>
                        </label>
                    `
                   /* return '<input type="checkbox" class="select-row" data-uuid="' + row[7] + '">';*/
                }
            },
            { title: "Clients" },
            { title: "Service" },
            { title: 'Type',
                render: function(data, type, row) {
                   if (data=='vip') {
                          return `<span class="badge bg-success">VIP</span>`;
                     }
                    else if (data=='standard') {
                        return `<span class="badge bg-warning">Standard</span>`;
                    }
                    else {
                        return `<span class="badge bg-secondary">Inconnu</span>`;
                    }
                }

             },
            { title: "Délais" },
            { title: "Date" },
            {
                title: 'Status',
                render: function(data, type, row) {
                    return getBadgeHtml(data,"100px");
                }
            },
            {
                title: 'Actions',
                render: function(data, type, row) {
                    return `
                    <a class="btn-sm text-white mx-1" data-mdb-ripple-init style="background-color: #2eca7f;" href="/admin/commande/get/${data}" role="button">
                        <i class="fa-regular fa-eye"></i>
                    </a>
                    <a class="btn-sm text-white mx-1 btn-reject" data-mdb-ripple-init style="background-color: #ca0000;" data-uuid="${data}" role="button">
                        <i class="fa-solid fa-xmark"></i>
                    </a>`;
                }
            }
        ]
    });

// Gestion du bouton "Tout sélectionner"
    $('#newCommandeTable').on('click', '#select-all', function() {
        let rows = newCommandeTable.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

// Gestion de la sélection de chaque ligne
    $('#newCommandeTable').on('change', '.select-row', function() {
        if (!this.checked) {
            let el = $('#select-all').get(0);
            if (el && el.checked && ('indeterminate' in el)) {
                el.indeterminate = true;
            }
        }
    });

// Pour effectuer une action sur les éléments sélectionnés
    $('#your-action-button').on('click', function() {
        let selectedUuids = [];
        newCommandeTable.$('.select-row:checked').each(function() {
            selectedUuids.push($(this).data('uuid'));
        });

        if (selectedUuids.length > 0) {
            // Faites quelque chose avec selectedUuids
           // console.log('UUIDs sélectionnés:', selectedUuids);
        } else {
            alert('Veuillez sélectionner au moins une ligne.');
        }
    });

    let _dataTable = $('#commandeTable').DataTable({
        pagingType: 'full_numbers',
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        columnDefs: [
            { className: "", targets: "_all" }
        ],
        initComplete: function(settings, json) {
            /* $('#formationTable').addClass('table 6');
             $('#myTable thead').addClass('border border-bottom border-light border-1');
             $('#myTable_length').addClass('custom-show-entries');
             $('#myTable_filter').addClass('custom-search');*/
        },
        ajax: {
            url: '/admin/commande/all/processing', // Remplacez par l'URL de votre API
            dataSrc: function (json) {
                // Transform the data format if needed
                return json.map(function(item) {
                    return [
                        item.reference,
                        item.client.fist_name +" "+ item.client.last_name,
                        item.service.name ,
                        item.structure_stage,
                        item.status.name,
                        item.uuid,
                    ];
                });
            }
        },
        columns: [
            { title: "Commandes" },
            { title: "Clients" },
            { title: "Service" },
            { title: 'Type',
                render: function(data, type, row) {
                   if (data=='vip') {
                          return `<span class="badge bg-success">VIP</span>`;
                     }
                    else if (data=='standard') {
                        return `<span class="badge bg-warning">Standard</span>`;
                    }
                    else {
                        return `<span class="badge bg-secondary">Inconnu</span>`;
                    }
                }

             },
            {
                title: 'Status',
                render: function(data, type, row) {
                    return getBadgeHtml(data,"100px");
                }

            },
            {
                title: 'Actions', // Nom de la colonne d'action
                render: function(data, type, row) {
                    return `
                         <a class="btn-sm text-white mx-1" data-mdb-ripple-init style="background-color: #2eca7f;" href="/admin/commande/get/${data}" role="button">
                        <i class="fa-regular fa-eye"></i>
                    </a>
                            `;
                }
            },
        ]
    })

    //rejeter une nouvelle commande
    $('#newCommandeTable tbody').on('click', '.btn-reject', function(e) {
        e.preventDefault();
        const uuid = $(this).data('uuid');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success mx-3",
                cancelButton: "btn btn-danger mx-3"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Voulez vous vraiment rejeter cette commande?",
            text: "Cet action est irreversible",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "oui",
            cancelButtonText: "non",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    type: 'POST',
                    url: `/admin/commande/reject`,
                    data:{ uuid: uuid },
                    dataType: 'JSON',
                    success: function (response) {
                       if(response.message==="success"){
                           newCommandeTable.ajax.reload();
                           swalWithBootstrapButtons.fire({
                               title: "Rejeté!",
                               text: "la commande été rejeté avec succèss.😊",
                               icon: "success"
                           });
                       }else if(response.message==="success"){
                           swalWithBootstrapButtons.fire({
                               title: "Erreur",
                               text: "Une erreur est survenu ressayer.😥",
                               icon: "error"
                           });
                       }
                    },
                    error: function (xhr, status, error) {
                        //console.error('Error:', error);
                        swalWithBootstrapButtons.fire({
                            title: "Erreur",
                            text: "Une erreur est survenu.😥",
                            icon: "error"
                        });
                    },
                    complete: function () {

                    }
                });

            } /*else if (
                /!* Read more about handling dismissals below *!/
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Your imaginary file is safe :)",
                    icon: "error"
                });
            }*/
        });
       // console.log(uuid);
    });
})
