import {StdevForm} from "../../stdev/js/StdevForm.js";
import {hideElement, showElement} from "../../stdev/js/StdeUsefulFunction.js";

document.addEventListener("DOMContentLoaded",function (){
    let isValideInput = true;
    const registerForm = document.getElementById('reclationForm');
    let stdevForm = new StdevForm();
    const csrfToken = document.querySelector('input[name="_token"]').value;

    document.querySelector('#reclamationSubmit').addEventListener('click',function (e){
        e.preventDefault();
    /*    this.disabled = true
        showElement(document.getElementById("spnBtnId"));*/
        stdevForm.setFormElement(registerForm);
        const fieldsConfig = {
            cmd_ref: {
                name: 'cmd_ref',
                typeField:{
                    textField:{
                        minLength:1,
                        maxLength: 50
                    },
                }
            },
            id_pay: {
                name: 'id_pay',
                typeField:{
                    textField:{
                        minLength:1,
                        maxLength: 50
                    },
                    digitsField:true,
                }
            },
        }
        let isValideInput= stdevForm.validateFields(
            ['cmd_ref','id_pay'],fieldsConfig,
            "border border-danger",
            'border border-success');
        if (isValideInput){
            document.querySelector("#submitRegisterBtnId").disabled = true;
            document.querySelector("#spnBtnId").hidden = false;

           // showElement(document.getElementById("spnBtnId"));
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
                  //  console.log(response);
                },
                error: function (xhr, status, error) {
                    //console.log(xhr);
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                    }
                },
                complete: function () {
                  /*  document.querySelector("#submitRegisterBtnId").disabled = false;
                    document.querySelector("#spnBtnId").hidden = true;*/
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
