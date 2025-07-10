import {extractDateTime} from "../../stdev/js/date.js";
import {getBadgeHtml} from "../../stdev/js/badgeHtml.js";
import {StdevForm} from "../../stdev/js/StdevForm.js";

document.addEventListener('DOMContentLoaded',()=>{
    const bdModal = $('#baseDonneModal');
    const bdForm = document.getElementById('bdForm');
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success mx-3",
            cancelButton: "btn btn-danger mx-3"
        },
        buttonsStyling: false
    });
    let dataTable = $('#dataTable').DataTable({
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
            url: '/admin/base-donne/all', // URL de votre API
            dataSrc: function (json) {
                return json.map(function(item) {
                    return [
                        '', // Colonne pour les checkboxes (remplie plus tard)
                        item.reference,
                        item.name,
                        item.amount ,
                        extractDateTime(item.updated_at,"DD-MM-YYYY").date,
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
            { title: "Référence" },
            { title: "Name" },
            { title:` <p style="text-align: start">Prix (F cfa)</p>` },
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

                    <a class="btn-sm text-white mx-1 edite-bd" data-mdb-ripple-init style="background-color: #2e9bca;" data-uuid="${data}" role="button">
                       <i class="fa-solid fa-pencil"></i>
                    </a>
                    <a class="btn-sm text-white mx-1 download-bd" data-mdb-ripple-init style="background-color: #2eca7f;" data-uuid="${data}" role="button">
                        <i class="fa-solid fa-download"></i>
                    </a>
                    <a class="btn-sm text-white mx-1 delete-bd" data-mdb-ripple-init style="background-color: #ca0000;" data-uuid="${data}" role="button">
                       <i class="fa-solid fa-trash"></i>
                    </a>`;
                }
            }
        ]
    });


// Gestion du bouton "Tout sélectionner"
    dataTable.on('click', '#select-all', function() {
        let rows = newCommandeTable.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

// Gestion de la sélection de chaque ligne
    dataTable.on('change', '.select-row', function() {
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

    //submit une bd form
    document.querySelector('#bdFormSubmit').addEventListener('click',(e)=>{
        e.preventDefault();
        const action = document.getElementById('bdFormSubmit').dataset.action;
        let stdevForm = new StdevForm();
        let isValideInput = false;
        stdevForm.setFormElement(bdForm);
        const fieldsConfig = {
            title:{
                name:'title',
                typeField:{
                    textField:{
                        minLength:1,
                        maxLength: 250,
                    },
                },
            },
            amount:{
                name:'amount',
                typeField:{
                    textField:{
                        minLength:1,
                        maxLength: 20,
                    },
                    digitsField:true,
                },
            },
            path:{
                name:'path',
                typeField:{
                    textField:{
                        minLength:1,
                        maxLength: 1000,
                    },
                },
            },
            description:{
                name:'description',
                typeField:{
                    textField:{
                        minLength:1,
                        maxLength: 1024,
                    },
                },
            }
        }

        isValideInput= stdevForm.validateFields(
            ['title','amount','path','description'],fieldsConfig,
            "form-control is-invalid",
            "form-control is-valid");
        if (isValideInput){
            document.querySelector("#bdFormSubmit").disabled = true;
            document.querySelector("#bdFormSubmit span").hidden = false;
            let url="";
            if (action==="add"){
                url = "/admin/base-donne/add/new";
            }
            if (action==="edit"){
                url = "/admin/base-donne/edit";
            }
            $.ajax({
                headers: {
                    'Accept': 'application/json;charset=utf-8',
                    'X-CSRF-TOKEN':csrfToken
                },
                url: url,
                type:'POST',
                data:stdevForm.getFormData(),
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response.message==="success"){
                        if (action==="add"){
                            swalWithBootstrapButtons.fire({
                                title: "Ajouté",
                                text: "Base de données ajoutée avec succès.😊",
                                icon: "success"
                            });
                        }else{
                            swalWithBootstrapButtons.fire({
                                title: "Enregitrer",
                                text: "Base de données modifiée avec succès.😊",
                                icon: "success"
                            });
                        }
                        dataTable.ajax.reload();
                        bdModal.modal('hide');

                    }else if(response.message==="success"){
                        swalWithBootstrapButtons.fire({
                            title: "Erreur",
                            text: "Une erreur est survenu ressayer.😥",
                            icon: "error"
                        });
                    }
                },
                error: function (xhr, status, error) {
                    swalWithBootstrapButtons.fire({
                        title: "Erreur",
                        text: "Une erreur est survenu ressayer.😥",
                        icon: "error"
                    });
                },
                complete: function () {
                    document.querySelector("#bdFormSubmit").disabled = false;
                    document.querySelector("#bdFormSubmit span").hidden = true;
                }
            });
        }

    })

    //editer bd
    $("#dataTable tbody").on('click', '.edite-bd', function(e) {
        e.preventDefault();
        const uuid = $(e.currentTarget).data('uuid');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            type: 'POST',
            url: `/admin/base-donne/get`,
            data: { uuid: uuid },
            dataType: 'JSON',
            success: function(response) {
                bdModal.modal('hide');
                bdForm.reset();
                document.getElementById('bdFormSubmit').dataset.action = "edit";
                document.getElementById("title").value = response.name;
                document.getElementById("amount").value = response.amount;
                document.getElementById("description").value = response.description;
                document.getElementById("uuid").value = response.uuid;
                bdModal.modal('show');
            },
            error: function(xhr, status, error) {
                swalWithBootstrapButtons.fire({
                    title: "Erreur",
                    text: "Une erreur est survenue.😥",
                    icon: "error"
                });
            },
            complete: function() {
                // Optional actions after the request is complete
            }
        });
    });
    //delete bd
    $("#dataTable tbody").on('click','.delete-bd',(e)=>{
        e.preventDefault();
        const uuid = $(e.currentTarget).data('uuid');
        swalWithBootstrapButtons.fire({
            title: "Être vous sur de vouloir supprimer la Base de donnée?",
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
                    url: `/admin/base-donne/delete`,
                    data: { uuid: uuid },
                    dataType: 'JSON',
                    success: function(response) {
                        swalWithBootstrapButtons.fire({
                            title: "Supprimée",
                            text: "Base de données supprimée avec succès.😊",
                            icon: "success"
                        });
                        dataTable.ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        swalWithBootstrapButtons.fire({
                            title: "Erreur",
                            text: "Une erreur est survenue.😥",
                            icon: "error"
                        });
                    },
                    complete: function() {
                        // Optional actions after the request is complete
                    }
                });

            }
        });

    });
    // bd download
    $("#dataTable tbody").on('click','.download-bd',(e)=>{
        e.preventDefault();
        const uuid = $(e.currentTarget).data('uuid');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            type: 'POST',
            url: '/admin/base-donne/download',
            data: { uuid: uuid },
            dataType: 'JSON',
            success: function (response) {
                if (response.message === "success") {
                    // Rediriger vers l'URL de téléchargement
                    window.location.href = response.download_url;
                } else {
                    swalWithBootstrapButtons.fire({
                        title: "Erreur",
                        text: "Une erreur est survenue lors du téléchargement.",
                        icon: "error"
                    });
                }
            },
            error: function () {
                swalWithBootstrapButtons.fire({
                    title: "Erreur",
                    text: "Impossible de traiter la requête.",
                    icon: "error"
                });
            }
        });
    });
    bdModal.on('hidden.bs.modal', function (e) {
        bdForm.reset();
        bdForm.dataset.action="add";
        bdModal.modal('hide');
    })

})
