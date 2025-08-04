document.addEventListener("DOMContentLoaded",function (){
    const csrfToken = document.querySelector('input[name="_token"]').value;



        document.querySelectorAll('.payer').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // Empêche le comportement par défaut du lien
            let uuid = this.getAttribute('data-uuid');
            let amount_type = this.getAttribute('data-amount-type');
            let spinner = this.querySelector('.spinner');
            let pay_status = this.getAttribute('data-pay-status');/*?.toLowerCase() || null*/;
            let pay_id = this.getAttribute('data-pay-id');
            let url ="/pay/commande/confirme";
            let data = {};

         //   console.log(uuid,pay_status);
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
                 //   console.log(response);

                    if(response.success ===true){

                    
                        var pay = document.createElement('button');


                     

                        pay.setAttribute('data-environment', 'live');
                        FedaPay.init(pay, {
                            public_key: 'pk_live_LGigNoUar3BScoocKua6YYxH',
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
                              //  console.log(reason);
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
                                           // console.log("response = ",response);
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
                                       // console.log("response = ",response);
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
                   // console.error(xhr.responseText);
                }
            });
        });
    })
})