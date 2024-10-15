import {StdevForm} from "../../stdev/js/StdevForm.js";
import {getBadgeHtml} from "../../stdev/js/badgeHtml.js";

document.addEventListener("DOMContentLoaded",()=>{
    const memberModale = $('#memberModale');
    const memberForm = document.getElementById("memberForm");
    const csrfToken = document.querySelector('input[name="_token"]').value;
    //process for add new member
    document.querySelector("#memberFormSubmit").addEventListener("click",(e)=>{
        e.preventDefault();
        let selectR = document.getElementById('role');
        var selectRole = selectR.options[selectR.selectedIndex].text;
        let stdevForm = new StdevForm();
        let isValideInput = false;
        stdevForm.setFormElement(memberForm);
        const fieldsConfig = {
            lastName:{
                name:'lastName',
                typeField:{
                    textField:{
                        minLength:1,
                        maxLength: 100,
                    },
                    digitsField:false,
                },
            },
            firstName:{
                name:'firstName',
                typeField:{
                    textField:{
                        minLength:1,
                        maxLength: 100,
                    },
                    digitsField:false,
                },
            },
            email:{
                name:'email',
                typeField:{
                    textField:{
                        minLength:1,
                        maxLength: 100,
                    },
                    emailField:true,
                    digitsField:false,
                },
            },
            phoneNumber:{
                name:'phoneNumber',
                typeField:{
                    textField:{
                        minLength:1,
                        maxLength: 20,
                    },
                    digitsField:true,
                },
            },

            password:{
                name:'password',
                typeField:{
                    textField:{
                        minLength:1,
                        maxLength: 100,
                    },
                },
            },
        }



       // console.log(fieldsConfig);
        isValideInput= stdevForm.validateFields(
            ['lastName','firstName','email','phoneNumber','password'],fieldsConfig,
            "form-control is-invalid",
            "form-control is-valid");
            if (selectRole ==='Affilier') {
                fieldsConfig.codeaf = {
                    name:'codeaf',
                    typeField:{
                        textField:{
                            minLength:1,
                            maxLength: 10,
                        },
                    },
                }

                isValideInput= stdevForm.validateFields(
                    ['codeaf'],fieldsConfig,
                    "form-control is-invalid",
                    "form-control is-valid");
            }

        if (isValideInput){
            document.querySelector("#memberFormSubmit").disabled = true;
            document.querySelector("#memberFormSubmit span").hidden = false;
           // console.log(stdevForm.getDataFormData());
            let url ="/admin/staff/add/member";
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
                    if (response.message === "success"){

                        $.notify({
                            title: 'Message😊',
                            message: 'Un nouveau membre ajouter ',
                        },{
                            type: 'success',
                            placement: {
                                from: "top",
                                align: "right"
                            },
                            time: 1000,
                        });
                        memberForm.reset();
                        memberModale.modal('hide');
                    }else {
                        $.notify({
                            title: 'Message 😥',
                            message: 'La demande a échouer réssayer ',
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
                        title: 'Message 😥',
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
                    document.querySelector("#memberFormSubmit").disabled = false;
                    document.querySelector("#memberFormSubmit span").hidden = true;
                }
            });
        }

    })

    //link
    document.querySelectorAll(".dropdown-item").forEach((item)=>{
        item.addEventListener('click',(e)=>{
            e.preventDefault();
            const referenceValue = item.dataset.reference;
            const action = item.dataset.action;

            let data = {}
            if (action === "detail"){
                data.reference=referenceValue;
                data._token = csrfToken;
                $.ajax({
                    headers: {
                        'Accept': 'application/json;charset=utf-8',
                        'X-CSRF-TOKEN': data._token
                    },
                    url: '/admin/staff/detail/member',
                    type: 'POST',
                    data: data,
                    dataType: 'JSON',
                    success: function (response) {
                        console.log(response);
                        document.getElementById("lastName").value=response.last_name;
                        document.getElementById("firstName").value=response.fist_name;
                        document.getElementById("email").value=response.user?.email??"";
                        document.getElementById("phoneNumber").value=response.phone_number;
                        document.getElementById("bio").value=response.bio;
                        document.getElementById("role").value=response.user?.role.id;
                        document.getElementById('memberFormSubmit').innerText = "MODIFIER"
                        memberModale.modal('show');
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr);
                    },
                    complete: function () {

                    }
                });
            }
            else
            {
               /* if (action === "detail"){
                    data.reference=referenceValue;
                    data._token = csrfToken;
                    $.ajax({
                        headers: {
                            'Accept': 'application/json;charset=utf-8',
                            'X-CSRF-TOKEN': data._token
                        },
                        url: '/admin/staff/detail/member',
                        type: 'POST',
                        data: data,
                        dataType: 'JSON',
                        success: function (response) {
                            console.log(response);
                            ;
                        },
                        error: function (xhr, status, error) {
                            console.log(xhr);
                        },
                        complete: function () {

                        }
                    });
                }*/

            }

        })
    })

    //femerture modale
    memberModale.on('hidden.bs.modal', function (e) {
        memberForm.reset();
        memberModale.modal('hide');
    })
    //
    document.getElementById('role').addEventListener('change', function() {
        var selectedText = this.options[this.selectedIndex].text;
        var codeaf = document.getElementById('codeaf-div');

        if (selectedText !== 'Affilier') {
            codeaf.hidden = true;
        } else {
            codeaf.hidden = false;
        }
    });

    //ouvert de l'app d'envoi de email
    document.querySelectorAll(".email").forEach((link)=>{
        link.addEventListener('click',(e)=>{
            e.preventDefault();
            const recipient = link.dataset.email;
            const subject = "";
            const body = "";
            // Construire l'URL mailto & Ouvrir le client de messagerie
            window.location.href = `mailto:${recipient}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
        })
    })
})
