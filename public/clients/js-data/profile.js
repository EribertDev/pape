import {StdevForm} from "../../stdev/js/StdevForm.js";
//import {hideElement} from "../../stdev/js/StdeUsefulFunction.js";

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('email').disabled=true;
    const infoForm = document.getElementById('infoForm');
    let stdevForm = new StdevForm();
    /*
    * ecoute du boutton modifier*/
    document.querySelector('#editBtn').addEventListener('click',function (e){
        e.preventDefault();
        stdevForm.setFormElement(infoForm);
        const fieldsConfig = {
            last_name: {
                name: 'last_name',
                typeField:{
                    textField:{
                        minLength:1,
                        maxLength: 50
                    },
                }
            },
            fist_name: {
                name: 'fist_name',
                typeField:{
                    textField:{
                        minLength:1,
                        maxLength: 50
                    },
                }
            },
            phone_number:{
                name:'phone_number',
                typeField:{
                    textField:{
                        minLength:8,
                        maxLength: 8,
                    },
                    digitsField:true
                },
            },
           /* email:{
                name:'email',
                typeField:{
                    textField:{
                        minLength:1,
                        maxLength: 100,
                    },
                    emailField:true,
                },
            },*/
           /* password:{
                name:'password',
                typeField:{
                    textField:{
                        minLength:8,
                        maxLength: 100,
                    },
                    passwordField:{
                        uppercase:false,
                        minLength:8,
                    },
                },
            }*/
        }
        let isValideInput= stdevForm.validateFields(
            ['last_name','fist_name','email','phone_number'],fieldsConfig,
            "border border-danger",
            'border border-danger');
        if (isValideInput){
            $('#comfimeEditModale').modal('show');
        }

    });

    /*
      Modification des informations du client
      */
    document.querySelector('#yesBtn').addEventListener('click',function (e){
        e.preventDefault();
        this.disabled = true;
        const csrfToken = document.querySelector('input[name="_token"]').value;
        $.ajax({
            headers: {
                'Accept': 'application/json;charset=utf-8',
                'X-CSRF-TOKEN':csrfToken
            },
            url: '/client-profile/edit',
            type:'POST',
            data: stdevForm.getFormData(),
            processData: false,
            contentType: false,
            dataType: 'JSON',
            success: function (response) {
               // console.log(response);
                location.reload();
            },
            error: function (xhr, status, error) {
              //  console.log(xhr);
            },
            complete: function () {
              //  document.getElementById('submitRegisterBtnId').innerHTML = `<span role="status">Créer un compte</span>`;
                document.getElementById('yesBtn').disabled = false
               // hideElement(document.getElementById("spnBtnId"));
            }
        });
    });


});

