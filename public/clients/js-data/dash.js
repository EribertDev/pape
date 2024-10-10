//

document.addEventListener("DOMContentLoaded", function() {
    const csrfToken = document.querySelector('input[name="_token"]').value;
   
    function downloadFile(uuid){
        $.ajax({
            url: '/download/commmande/finale/file', // Remplacez par l'URL cible de votre requête
            type: 'POST',
            data: {
                uuid: uuid,
                _token:csrfToken// Ajoutez le token CSRF si nécessaire
            },
            success: function(response) {
                console.log(response);
                if (response.success) {
                    var link = document.createElement('a');
                    link.href = response.data;  
                    link.download =  response.filename;  
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    document.getElementById("s_title_msg").innerHTML = "Téléchargement du fichier...";
                            document.getElementById("s_msg").innerHTML = "";
                            $('#payModal').modal('show');
                }else{
                    document.getElementById("e_title_msg").innerHTML = "Commande non terminée";
                document.getElementById("e_msg").innerHTML = "Votre commande est en cours de traitement.<br> Nous vous tiendrons informé dans un bref délais.<br> Merci pour votre patience.";
                $('#payErrorModal').modal('show');
                }
            },

            error: function(xhr) {
                document.getElementById("e_title_msg").innerHTML = "Une erreur s'est produite";
                document.getElementById("e_msg").innerHTML = "Veuillez reessayer";
                $('#payErrorModal').modal('show');
            }
        });
    }

    document.querySelectorAll('.download').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // Empêche le comportement par défaut du lien
            var uuid = this.getAttribute('data-uuid');
            let spinner = this.querySelector('.spinner');
            downloadFile(uuid);
        });
    });
    //
    document.querySelectorAll('.payer').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // Empêche le comportement par défaut du lien
            let uuid = this.getAttribute('data-uuid');
            let amount_type = this.getAttribute('data-amount-type');
            let spinner = this.querySelector('.spinner');
            let pay_status = this.getAttribute('data-pay-status');/*?.toLowerCase() || null*/;
            let pay_id = this.getAttribute('data-pay-id');
            let url ="";
            let data = {};

            console.log(uuid,pay_status);
            if (pay_status === "Payer") {
                downloadFile(uuid);
            }else{
                spinner.hidden = false;
                url = "/pay/commande";
                data = {
                    uuid: uuid,
                    pay_id:pay_id,
                    amount_type:amount_type,
                    _token:csrfToken
                };
            }
            $.ajax({
                url: url, 
                type: 'POST',
                data:data,
                success: function(response) {
                    console.log(response);
                    if(response.success ===true){
                        var pay = document.createElement('button');
                        pay.setAttribute('data-environment', 'sandbox');
                        FedaPay.init(pay, { 
                            public_key: 'pk_sandbox_YejKf1nZO1d3XEGd61VK1IOV',
                            customer:{
                                lastname:response.data.client?.last_name,
                                firstname:response.data.client?.fist_name,
                            },
                            transaction: {
                                id: response.data.transaction_id??null,
                                description: response.data.description,
                                amount: response.data.amount
                            },
                            onComplete: function(reason) {
                                console.log(reason);
                               if(reason?.reason === "CHECKOUT COMPLETE"){
                                    $.ajax({
                                        url: '/pay/commande/finish', // Remplacez par l'URL cible de votre requête
                                        type: 'POST',
                                        data: {
                                            id: response.data.id,
                                            status:reason?.transaction.status,
                                            transaction_id : reason?.transaction.id,
                                            reference:reason?.transaction.reference,
                                            _token:csrfToken// Ajoutez le token CSRF si nécessaire
                                        },
                                        success: function(response) {
                                            console.log("response = ",response);
                                            if (response.success===true) {
                                                $('#payModal').modal('show');
                                            }
                                           // window.location.reload();
                                        },
                                        error: function(xhr) {
                                            
                                        },
                                        complete: function() {
                                             spinner.hidden = true; 
                                        }
                                    });
                               }else{
                                $.ajax({
                                    url: '/pay/commande/finish', // Remplacez par l'URL cible de votre requête
                                    type: 'POST',
                                    data: {
                                        id: response.data.id,
                                        transaction_id : reason?.transaction.id,
                                        reference:reason?.transaction.reference,
                                        status:reason?.transaction.status,
                                        _token:csrfToken// Ajoutez le token CSRF si nécessaire
                                    },
                                    success: function(response) {
                                        console.log("response = ",response);
                                       if (response.success===true) {
                                           // document.getElementById("ref__cmd").innerHTML = response.data?.cmd_ref;
                                            //document.getElementById("id__pay").innerHTML = response.data?.transaction_id;
                                       }
                                         //   document.getElementById("id_pay").value = reason?.transaction.id;
                                        
                                        $('#payErrorModal').modal('show');
                                    },
                                    error: function(xhr) {
                                        
                                    },
                                    complete: function() {
                                        spinner.hidden = true;           
                                    }
                                });
                               }
                           /*     console.log(reason);
                                console.log(transaction);*/
                            }
                    
                        });
                        pay.click();
                    
                   }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    })

    document.querySelectorAll('.payer_confirme').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // Empêche le comportement par défaut du lien
            let uuid = this.getAttribute('data-uuid');
            let spinner = this.querySelector('.spinner');
            let pay_status = this.getAttribute('data-pay-status');/*?.toLowerCase() || null*/;
            let pay_id = this.getAttribute('data-pay-id');
            let url ="/pay/commande/confirme";
            let data = {};
           // console.log(uuid,pay_status);
            data = {
              //  uuid: uuid,
                pay_id:pay_id,
                //     amount_type:amount_type,
                _token:csrfToken
            };
            
            $.ajax({
                url: url, 
                type: 'POST',
                data:data,
                success: function(response) {
                    console.log(response);
                    if(response.success ===true){
                        if (response.data?.status === "Payer") {
                            document.getElementById("s_title_msg").innerHTML = "Paiement vérifier avec Succès";
                            document.getElementById("s_msg").innerHTML = "Votre paiement a été vérifier avec Succès.<br/> Merci pour votre confiance";
                            $('#payModal').modal('show');
                        }else{
                            document.getElementById("e_title_msg").innerHTML = "Paiement non vérifier";
                            document.getElementById("e_msg").innerHTML = "Votre paiement n'a pas été vérifier <br/> veuillez confirmer votre paiement et reessayer";
                            $('#payErrorModal').modal('show');
                        }
                    }
                },
                error: function(xhr) {
                    document.getElementById("e_title_msg").innerHTML = "Une erreur s'est produite";
                            document.getElementById("e_msg").innerHTML = "Veuillez reessayer";
                            $('#payErrorModal').modal('show');
                }
            });
        });
    })
    //
    document.querySelectorAll('.cancel__pay').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // Empêche le comportement par défaut du lien
            $('#payErrorModal').modal('hide');
            window.location.reload();
        });
    })

    $('#payErrorModal').on('hidden.bs.modal', function (e) {
        window.location.reload();
      })
    $('#payModal').on('hidden.bs.modal', function (e) {
        window.location.reload();
      })
})

