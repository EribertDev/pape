import {StdevForm} from "../../stdev/js/StdevForm.js";
import {hideElement, showElement} from "../../stdev/js/StdeUsefulFunction.js";

document.addEventListener("DOMContentLoaded",function (){
    hideElement(document.getElementById("alert"));
    let isValideInput = true;
    const registerForm = document.getElementById('registerForm');
    let stdevForm = new StdevForm();
    const csrfToken = document.querySelector('input[name="_token"]').value;

    document.querySelector('#submitRegisterBtnId').addEventListener('click',function (e){
        e.preventDefault();
    /*    this.disabled = true
        showElement(document.getElementById("spnBtnId"));*/
        stdevForm.setFormElement(registerForm);
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
            _email:{
                name:'_email',
                typeField:{
                    textField:{
                        minLength:1,
                        maxLength: 100,
                    },
                    emailField:true,
                },
            },
            _password:{
                name:'_password',
                typeField:{
                    textField:{
                        minLength:8,
                        maxLength: 100,
                    },
                    /*passwordField:{
                        uppercase:false,
                        minLength:8,
                    },*/
                },
            }
        }
        let isValideInput= stdevForm.validateFields(
            ['last_name','fist_name','_email','phone_number','_password'],fieldsConfig,
            "border border-danger",
            'border border-success');
        if (isValideInput){
            document.querySelector("#submitRegisterBtnId").disabled = true;
            document.querySelector("#spnBtnId").hidden = false;

            showElement(document.getElementById("spnBtnId"));
            $.ajax({
                headers: {
                    'Accept': 'application/json;charset=utf-8',
                    'X-CSRF-TOKEN':csrfToken
                },
                url: '/register/client',
                type:'POST',
                data: stdevForm.getFormData(),
                processData: false,
                contentType: false,
                dataType: 'JSON',
                success: function (response) {
                   // console.log(response);
                    document.getElementById('registerForm').reset();
                    $('#loginModal').modal('show');
                    $('#registerModal').modal('hide');
                },
                error: function (xhr, status, error) {
                    //console.log(xhr);
                   document.getElementById('alertErrorId').innerHTML = ""; // Vide les messages précédents
                    showElement(document.getElementById("alert"));
                    let msg;
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            msg+= '<li>' + value[0] + '</li> ';
                           // console.log(value[0]);

                        });
                        document.getElementById('alert').innerHTML =
                         `<div class="alert alert-danger">
                         <ul>
                           ${msg}
                         </ul>

                          </div>`;
                        //showElement(document.getElementById("alert"));
                    }
                },
                complete: function () {
                    document.querySelector("#submitRegisterBtnId").disabled = false;
                    document.querySelector("#spnBtnId").hidden = true;
                }
            });
        }

    })

    document.querySelectorAll('input').forEach(function(element) {
        element.addEventListener('input', function(event) {
           hideElement(document.getElementById("alert"));
        });
    });
})
