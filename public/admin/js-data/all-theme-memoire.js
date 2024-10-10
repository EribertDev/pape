import {extractDateTime} from "../../stdev/js/date.js";
import {getBadgeHtml} from "../../stdev/js/badgeHtml.js";
import {StdevForm} from "../../stdev/js/StdevForm.js";
import {truncateString} from "../../stdev/js/StdeUsefulFunction.js";

document.addEventListener('DOMContentLoaded',()=>{
    const TMModal = $('#TMModal');
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
            url: '/admin/theme-memoire/all', // URL de votre API
            dataSrc: function (json) {
                return json.map(function(item) {
                    return [
                        truncateString(item.title, 50),
                       // truncateString(item.description, 30),
                        item.status.name,
                        item.uuid,
                        item.path,
                    ];
                });
            }
        },
        columns: [
            {
                title: 'Thèmes',
                render: function(data, type, row) {
                    return `<p style="width:350px;">${data}</p>`;
                }
            },
           /* {
                title: 'Description',
                render: function(data, type, row) {
                    return `<p style="width:220px;">${data}</p>`;
                }
            },*/
            {
                title: 'Statut',
                render: function(data, type, row) {
                    return getBadgeHtml(data, "100px");
                }
            },
            {
                title: 'Actions',
                render: function(data, type, row) {
                    return `
                 
                        <a class="btn-sm text-white mx-1 edite-bd" data-mdb-ripple-init style="background-color: #2e9bca;" data-uuid="${data}" role="button">
                           <i class="fa-solid fa-pencil"></i>
                        </a>
                        <a class="btn-sm text-white mx-1 delete-bd" data-mdb-ripple-init style="background-color: #ca0000;" data-uuid="${data}" role="button">
                           <i class="fa-solid fa-trash"></i>
                        </a>`;
                }
            }
        ],
        rowCallback: function(row, data) {
            // Vérifier l'état de item.path
       /*     if (data[3] === null || data[3] === '') { // Assurez-vous que l'index est correct
                $(row).addClass('bg-light'); // Utilisation de la classe Bootstrap pour colorier la ligne
            } else {
                row.style.backgroundColor = '#00ff4c'; // Couleur de fond pour non null
                row.style.color = '#ffffff'; // Couleur du texte
            }
                */
        }
    });
    


    //submit une bd form
    document.querySelector('#TMFormSubmit').addEventListener('click',(e)=>{
        e.preventDefault();
        const action = document.getElementById('TMFormSubmit').dataset.action;
        let stdevForm = new StdevForm();
        let isValideInput = false;
        stdevForm.setFormElement(bdForm);
        
        const fieldsConfig = {
            theme:{
                name:'theme',
                typeField:{
                    textField:{
                        minLength:1,
                        maxLength: 250,
                    },
                },
            },
            // protocole:{
            //     name:'protocole',
            //     typeField:{
            //         textField:{
            //             minLength:1,
            //             maxLength: 1000,
            //         },
            //     },
            // },
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
            ['theme','description'],fieldsConfig,
            "form-control is-invalid",
            "form-control is-valid");
        if (isValideInput){
            document.querySelector("#TMFormSubmit").disabled = true;
            document.querySelector("#TMFormSubmit span").hidden = false;
            let url="";
            if (action==="add"){
                url = "/admin/theme-memoire/add/new";
            }
            if (action==="edit"){
                url = "/admin/theme-memoire/edit";
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
                                text: "Thème de mémoire ajoutée avec sucè.😊",
                                icon: "success"
                            });
                        }else{
                            swalWithBootstrapButtons.fire({
                                title: "Enregitrer",
                                text: "Thème de mémoire modifiée avec sucè.😊",
                                icon: "success"
                            });
                        }
                        dataTable.ajax.reload();
                        TMModal.modal('hide');

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
                    document.querySelector("#TMFormSubmit").disabled = false;
                    document.querySelector("#TMFormSubmit span").hidden = true;
                }
            });
        }

    });
    //editer tm
    $("#dataTable tbody").on('click', '.edite-bd', function(e) {
        e.preventDefault();
        const uuid = $(e.currentTarget).data('uuid');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            type: 'POST',
            url: `/admin/theme-memoire/get`,
            data: { uuid: uuid },
            dataType: 'JSON',
            success: function(response) {
                TMModal.modal('hide');
                bdForm.reset();
                document.getElementById('TMFormSubmit').dataset.action = "edit";
                document.getElementById("theme").value = response.title;
                document.getElementById("description").value = response.description;
                document.getElementById("uuid").value = response.uuid;
                TMModal.modal('show');
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
    //delete tm
    $("#dataTable tbody").on('click','.delete-bd',(e)=>{
        e.preventDefault();
        const uuid = $(e.currentTarget).data('uuid');
        swalWithBootstrapButtons.fire({
            title: "Être vous sur de vouloir supprimer ce thème de mémoire?",
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
                    url: `/admin/theme-memoire/delete`,
                    data: { uuid: uuid },
                    dataType: 'JSON',
                    success: function(response) {
                        swalWithBootstrapButtons.fire({
                            title: "Supprimée",
                            text: "thème de mémoire supprimée avec sucè.😊",
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
    // tm download
    $("#dataTable tbody").on('click','.download-bd',(e)=>{
        e.preventDefault();
        const uuid = $(e.currentTarget).data('uuid');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            type: 'POST',
            url: '/admin/theme-memoire/download',
            data: { uuid: uuid },
            dataType: 'JSON',
            success: function (response) {
                if (response.message === "success") {
                    // Rediriger vers l'URL de téléchargement
                    window.open(response.download_url, '_blank');
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
    //modal hide event
    TMModal.on('hidden.bs.modal', function (e) {
        bdForm.reset();
        bdForm.dataset.action="add";
        TMModal.modal('hide');
    })

})
