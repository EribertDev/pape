import {getBadgeHtml} from "../../stdev/js/badgeHtml.js";
import {extractDateTime} from "../../stdev/js/date.js";
import {hideElement} from "../../stdev/js/StdeUsefulFunction.js";


document.addEventListener("DOMContentLoaded",function (){
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let payemmentId = $('#payemmentId').DataTable({
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
            url: '/admin/payements/all', // URL de votre API
            dataSrc: function (json) {
                return json.map(function(item) {
                    return [
                        '', // Colonne pour les checkboxes (remplie plus tard)
                        item.reference,
                        `<p style="width: 70px;font-size: 14px; text-align: left ">${ item.amount}</p>`,
                        `<p style="width: 110px;font-size: 14px">${item.description}</p>`,
                        `<p style="width: 80px;font-size: 14px">${extractDateTime(item.updated_at,"DD-MM-YYYY","HH:mm").date}</p>`,
                        item.status.name,
                        item.commande.reference,
                        item.reference,
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
            { title: "ID" },
            { title:`<p style="width: 70px;font-size: 14px; text-align: start">Montant</p>`},
            { title: "Objet" },
            { title: "Date" },
            {
                title: 'Status',
                render: function(data, type, row) {
                    return getBadgeHtml(data,"80px");
                }
            },
            { title: "Commandes" },
            {
                title: 'Actions',
                render: function(data, type, row) {
                    return`
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end"  data-mdb-ripple-init data-mdb-tooltip-init data-mdb-placement="top" title="Copier">
                            <a class="btn-sm text-white mx-1 copy" data-mdb-ripple-init style="background-color: #2eca7f;" href="/admin/commande/get/${data}" role="button">
                                <i class="fa-regular fa-copy"></i>
                            </a>
                    </div>`;
                }
            }
        ]
    });
// Gestion du bouton "Tout sélectionner"
    $('#payemmentId').on('click', '#select-all', function() {
        let rows = payemmentId.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

// Gestion de la sélection de chaque ligne
    $('#payemmentId').on('change', '.select-row', function() {
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
        payemmentId.$('.select-row:checked').each(function() {
            selectedUuids.push($(this).data('uuid'));
        });

        if (selectedUuids.length > 0) {
            // Faites quelque chose avec selectedUuids
          //  console.log('UUIDs sélectionnés:', selectedUuids);
        } else {
            alert('Veuillez sélectionner au moins une ligne.');
        }
    });

    $('#payemmentId tbody').on('click', '.copy', function(e) {
        e.preventDefault();
        // Récupère la ligne de la table associée au bouton cliqué
        let table = $('#payemmentId').DataTable();
        let row = table.row($(this).closest('tr'));
        let data = row.data();
        let reference = data[6]; // Récupère le contenu de la colonne "Montant"
        navigator.clipboard.writeText(reference).then(() => {
          //  console.log('Montant copié dans le presse-papiers');
        }).catch(err => {
         //   console.error('Erreur lors de la copie dans le presse-papiers : ', err);
        });
    });


})
