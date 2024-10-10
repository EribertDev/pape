import {StdevForm} from "../../stdev/js/StdevForm.js";
import {hideElement, showElement} from "../../stdev/js/StdeUsefulFunction.js";

document.addEventListener("DOMContentLoaded",function (){
    let isValideInput = true;
    const loginForm = document.getElementById('loginForm');
    let stdevForm = new StdevForm();
    const csrfToken = document.querySelector('input[name="_token"]').value;

    document.querySelector('#submitLoginBtnId').addEventListener('click',function (e){
        e.preventDefault();
        this.disabled = true;
        stdevForm.setFormElement(loginForm);
        const fieldsConfig = {
            email:{
                name:'email',
                typeField:{
                    textField:{
                        minLength:1,
                        maxLength: 100,
                    },
                    emailField:true,
                },
            },
            password:{
                name:'password',
                typeField:{
                    textField:{
                        minLength:8,
                        maxLength: 100,
                    },
                },
            }
        }
        isValideInput= stdevForm.validateFields(
            ['email','password'],fieldsConfig,
            "border border-danger",
            'border border-success');
        if (isValideInput) {
            // Affiche le spinner et désactive le bouton
            document.getElementById('spinner-1').hidden = false;
            this.disabled = true;

            $.ajax({
                headers: {
                    'Accept': 'application/json;charset=utf-8',
                    'X-CSRF-TOKEN': csrfToken
                },
                url: '/login',
                type: 'POST',
                data: stdevForm.getFormData(),
                processData: false,
                contentType: false,
                dataType: 'JSON',
                success: function (response) {
                    document.getElementById('loginForm').reset(); // Réinitialise le formulaire
                    $('#loginModal').modal('hide'); // Ferme le modal de connexion
                    console.log(response);

                    // Redirection selon le rôle de l'utilisateur
                    if (response.success === true) {
                        if (response.data.role === 'Client') {
                            window.location.reload(); // Recharge la page pour les clients
                        } else {
                            window.location.href = '/admin/dash'; // Redirige vers le tableau de bord admin
                            console.log(response.data.role);
                        }
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                    document.getElementById('alertErrorId').innerHTML = `
                <div class="alert alert-danger d-flex align-items-center">
                    Nous n'avons pas pu vous connecter à votre compte.
                    Veuillez vérifier vos identifiants et réessayer.
                </div>`;
                },
                complete: function () {
                    // Réactive le bouton de soumission et masque le spinner
                    document.getElementById('submitLoginBtnId').disabled = false;
                    document.getElementById('spinner-1').hidden = true;
                }
            });
        }

    })

    document.querySelectorAll('input').forEach(function(element) {
        element.addEventListener('input', function(event) {
            document.getElementById('alertErrorId').innerHTML=``;

        });
    });
})
