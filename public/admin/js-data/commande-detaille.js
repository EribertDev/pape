import {StdevForm} from "../../stdev/js/StdevForm.js";
import {getBadgeHtml} from "../../stdev/js/badgeHtml.js";
import {
    /*clearLocalStorage,
    generateRandomString,
    getLocalStorage,
    hideElement,
    setLocalStorage,
    showElement,*/
    addClass,
    removeClass,
} from "../../stdev/js/StdeUsefulFunction.js";

document.addEventListener("DOMContentLoaded",function (){

    const csrfToken = document.querySelector('input[name="_token"]').value;
    //statut de la commande
    const cmdStatus = document.getElementById("cmdStatus");
    cmdStatus.innerHTML=getBadgeHtml(_statusCmd,"100px");
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success mx-3",
            cancelButton: "btn btn-danger mx-3"
        },
        buttonsStyling: false
    });
 /*   document.querySelector("#btnApprouve").addEventListener("click",(e)=>{
        e.preventDefault();
        let isValideInput = true;
        const payementForm = document.getElementById('payementForm');
        let stdevForm = new StdevForm();

        let url="";
        let bntText = document.getElementById("btnApprouve").innerText;
        if (bntText.trim() ==="APPROUVÉ"){
            url ="/admin/commande/approved";
        }else if (document.getElementById("btnApprouve").innerText==="MODIFIER"){

        }

        stdevForm.setFormElement(payementForm);
        const fieldsConfig = {
            priseContact:{
                name:'priseContact',
                typeField:{
                    textField:{
                        minLength:1,
                        maxLength: 12
                    },
                    digitsField:true,
                },
            },
            tranche1:{
                name:'tranche1',
                typeField:{
                    textField:{
                        minLength:1,
                        maxLength: 12
                    },
                    digitsField:true,
                },
            },
            tranche2:{
                name:'tranche2',
                typeField:{
                    textField:{
                        minLength:1,
                        maxLength: 12
                    },
                    digitsField:true,
                },
            }
        }
        isValideInput= stdevForm.validateFields(
            ['priseContact','tranche1','tranche2'],fieldsConfig,
            "form-control is-invalid",
            "form-control is-valid");
        if (isValideInput){
            document.getElementById("btnApprouve").disabled=true;
            document.getElementById("spinner").hidden=false;
            $.ajax({
                headers: {
                    'Accept': 'application/json;charset=utf-8',
                    'X-CSRF-TOKEN':csrfToken
                },
                url: url,
                type:'POST',
                data: stdevForm.getFormData(),
                processData: false,
                contentType: false,
                dataType: 'JSON',
                success: function (response) {
                   console.log(response);
                    if (response.message === "success"){
                        cmdStatus.innerHTML=getBadgeHtml("Approuvé","100px");
                        $.notify({
                            title: 'Message',
                            message: 'La commande à été approuvé avec succès ',
                        },{
                            type: 'success',
                            placement: {
                                from: "top",
                                align: "right"
                            },
                            time: 1000,
                        });
                        window.location.reload();
                        document.getElementById("btnApprouve").innerText = "MODIFIER";
                    }else {
                        $.notify({
                            title: 'Message',
                            message: 'La commande à été approuvé avec succès ',
                        },{
                            type: 'error',
                            placement: {
                                from: "top",
                                align: "right"
                            },
                            time: 1000,
                        });
                    }
                },
                error: function (xhr, status, error) {
                   // console.log(error);
                    $.notify({
                        title: 'Message',
                        message: 'Un erreur est survenu',
                    },{
                        type: 'danger',
                        placement: {
                            from: "top",
                            align: "right"
                        },
                        time: 1000,
                    });
                },
                complete: function () {
                    document.getElementById("btnApprouve").disabled=false;
                    document.getElementById("spinner").hidden=true;
                }
            });
        }
    });
*/
    document.getElementById("addRedactor").addEventListener("click",(e)=>{
        e.preventDefault();
        let data ={
            redactorId : document.getElementById('redactorSelect').value,
            cmdUuid:document.getElementById('cmdUuid').value,
        };
        document.getElementById("addRedactor").disabled=true;
        document.getElementById("redactorSelect").disabled=true;
        document.getElementById("spinner-2").hidden=false;
        $.ajax({
            headers: {
                'Accept': 'application/json;charset=utf-8',
                'X-CSRF-TOKEN':csrfToken
            },
            url: '/admin/commande/add/redactor',
            type:'POST',
            data:data,
            dataType: 'JSON',
            success: function (response) {
                if (response.message==="success"){
                    window.location.reload();
                }
            },
            error: function (xhr, status, error) {
                // console.log(error);
            },
            complete: function () {
                document.getElementById("btnApprouve").disabled=false;
                document.getElementById("spinner-2").hidden=true;
                document.getElementById("addRedactor").disabled=false;
            }
        });

    });

    function reject(){

        let data ={
            uuid:document.getElementById('cmdUuid').value,
        };

        $.ajax({
            headers: {
                'Accept': 'application/json;charset=utf-8',
                'X-CSRF-TOKEN':csrfToken
            },
            url: '/admin/commande/reject',
            type:'POST',
            data:data,
            dataType: 'JSON',
            success: function (response) {
                if (response.message==="success"){
                    window.location.href="/admin/commande";
                }
            },
            error: function (xhr, status, error) {
                // console.log(error);
            },
            complete: function () {

            }
        });
    }

   
    document.querySelectorAll(".reject").forEach(btn => {
        btn.addEventListener("click", (e) => {
            e.preventDefault();
            console.log("Click")
            reject();
        });
    });
    //
    document.querySelectorAll(".accepter").forEach(btn => {
        btn.addEventListener("click", () => {
           // console.log(document.getElementById('cmdUuid').value);
            let data ={
                uuid:document.getElementById('cmdUuid').value,
            };
    
            $.ajax({
                headers: {
                    'Accept': 'application/json;charset=utf-8',
                    'X-CSRF-TOKEN':csrfToken
                },
                url: '/admin/commande/approved',
                type:'POST',
                data:data,
                dataType: 'JSON',
                success: function (response) {
                    if (response.message==="success"){
                        window.location.href="/admin/commande";
                    }
                },
                error: function (xhr, status, error) {
                    // console.log(error);
                },
                complete: function () {
    
                }
            });
        });
    });
    //
    document.querySelectorAll(".send").forEach(btn => {
        btn.addEventListener("click", (e) => {
            e.preventDefault();
           const ficheForm = document.getElementById('ficheForm');
            let stdevForm = new StdevForm();
            let isValideInput = true;
            stdevForm.setFormElement(ficheForm);

           
           if(document.getElementById('customFile').value.length<=0){
               removeClass('customFile', "form-control is-valid")
               addClass('customFile', "form-control is-invalid");
               isValideInput=false
           }else{
               removeClass('customFile', "form-control is-invalid")
               addClass('customFile', "form-control is-valid");
           }
           if (isValideInput){
               document.querySelector(".send").disabled = true;
               document.querySelector(".send span").hidden = false;
               $.ajax({
                   headers: {
                       'Accept': 'application/json;charset=utf-8',
                       'X-CSRF-TOKEN':csrfToken
                   },
                   url: '/admin/commande/fileUpdate',
                   type:'POST',
                   data:stdevForm.getFormData(),
                   dataType: 'JSON',
                   processData: false,
                   contentType: false,
                   success: function (response) {
                       if(response.success===true){
                            window.location.reload();
                            swalWithBootstrapButtons.fire({
                                title: "Ajouté",
                                text: "Thème de mémoire ajoutée avec succè.😊",
                                icon: "success"
                            });  
                       }else if(response.success===false){
                            
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
                       document.querySelector(".send").disabled = false;
                       document.querySelector(".send span").hidden = true;
                   }
               });
           }
        });
    });
    
});




