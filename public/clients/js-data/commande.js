 import {StdevForm} from "../../stdev/js/StdevForm.js";
import {
    clearLocalStorage,
    generateRandomString,
    getLocalStorage,
    hideElement,
    setLocalStorage,
    showElement,
    addClass,
    removeClass,
} from "../../stdev/js/StdeUsefulFunction.js";
// Fonction pour sauvegarder la valeur d'un champ dans le localStorage lors du changement
function saveInputToLocalStorage(event) {
    const input = event.target;
    setLocalStorage(input.name, input.value);
}
// Fonction pour initialiser le formulaire avec les données du localStorage
function initializeFormFromLocalStorage() {
    const formElements = document.querySelectorAll('#cmdForm input, #cmdForm select, #cmdForm textarea');
    formElements.forEach(function (element) {
        const savedValue = getLocalStorage(element.name);
        if (savedValue) {
            element.value = savedValue;
        }
    });
}
// Ajouter les événements de changement sur chaque champ du formulaire
function attachInputChangeEvents() {
    const formElements = document.querySelectorAll('#cmdForm input, #cmdForm select, #cmdForm textarea');
    formElements.forEach(function (element) {
        element.addEventListener('change', saveInputToLocalStorage);
    });
}
//
document.addEventListener("DOMContentLoaded", function() {

    //  initializeFormFromLocalStorage();
    // attachInputChangeEvents();
    //
    let dateCommande={};
    let isValideInput = true;
    const cmdForm = document.getElementById('cmdForm');
    let stdevForm = new StdevForm();
    let service = "Rédaction complète";
    let montant =0;
    let serviceType = document.getElementById('serviceType').value || "standard";

    const dateInput = document.getElementById('deadline');
    const today = new Date();
    // Format de la date en YYYY-MM-DD
    const day = String(today.getDate()+1).padStart(2, '0');
    const month = String(today.getMonth() + 1).padStart(2, '0'); // Les mois commencent à 0
    const year = today.getFullYear();
    const formattedDate = `${year}-${month}-${day}`;
    // Définir la date minimale pour l'input
    dateInput.setAttribute('min', formattedDate);

    

   
    const csrfToken = document.querySelector('input[name="_token"]').value;
  

    document.querySelector('#commanderBtn').addEventListener("click",function (){
        
        if (typeof isAuthenticated !== 'undefined' ){
            stdevForm.setFormElement(cmdForm);
           // console.log(service)
            //regle de validation des champs
            const fieldsConfig = {
                subject: {
                    name: 'subject',
                    typeField:{
                        textField:{
                            minLength:0,
                            maxLength: 255,
                        },
                    }
                },
                
                description:{
                    name:'description',
                    typeField:{
                        textField:{
                            minLength:0,
                            maxLength: 10000,
                        },
                    },
                },
                deadline:{
                    name:'deadline',
                    typeField:{
                        textField:{
                            minLength:0,
                            maxLength: 10,
                        },
                    },
                },
                codeAf:{
                    name:'codeAf',
                    typeField:{
                        numericField:{
                            minLength:4,
                            maxLength: 8,
                            
                        },
                    },
                },
                universite:{
                    name:'universite',
                    typeField:{
                        textField:{
                            minLength:1,
                            maxLength: 200
                        },
                        
                    },
                },
                type_universite:{
                    name:'type_universite',
                    typeField:{
                        textField:{
                            minLength:1,
                            maxLength: 100
                        },
                        
                    },
                },
                pays:{
                    name:'pays',
                    typeField:{
                        textField:{
                            minLength:1,
                            maxLength: 200
                        },
                        
                    },
                },
               
               
               
            };
            //verification des champs
           // console.log(stdevForm.getDataFormData())
           
            isValideInput= stdevForm.validateFields(
                ['subject','description','universite','codeAf','pays','deadline','type_universite'],fieldsConfig,
                "border border-danger",
                'border border-success');
                if (!(service.includes("Rédaction complète") || service.includes("Protocole"))) {
                        if(document.getElementById('descrip_file').value.length<=0){
                            removeClass('descrip_file', "border border-success")
                            addClass('descrip_file', "border border-danger");
                            isValideInput=false
                        }else{
                            removeClass('descrip_file', "border border-danger")
                            addClass('descrip_file', "border border-success");
                        }
                }
                if (typeof isAuthenticated === 'undefined' ){
                    $('#loginModal').modal('show');
                }
            if (isValideInput){
                
                $('#conditionOfUseModale').modal('show');
            }
        }else {
            $('#loginModal').modal('show');
        }
    });

    //
    document.querySelector("#acceptedConditionBtn").addEventListener("click",function (event){

        event.preventDefault();
        const checkBoxConditionId = document.getElementById('checkBoxConditionId');
        if (checkBoxConditionId.checked){
            document.getElementById('commanderBtn').hidden = true;
            document.querySelector('#acceptedConditionBtn span').hidden = false
            
            console.log(stdevForm.getFormData());
            $.ajax({
                headers: {
                    'Accept': 'application/json;charset=utf-8',
                    'X-CSRF-TOKEN':csrfToken
                },
                url: '/service-offre/commande/verify',
                type:'POST',
                data: stdevForm.getFormData(),
                processData: false,
                contentType: false,
                dataType: 'JSON',

                success: function (response) {
                    $('#conditionOfUseModale').modal('hide');
                    
                    if(response.success===true){
                        clearLocalStorage();
                        window.location.href = "/service-offre/commandeFinish/"+response.data.idCmd;
                    
                    }
                   
                },
                error: function (xhr, status, error) {
                    document.getElementById('commanderBtn').hidden = false;
                    
                },
                complete: function () {
                    Loader.close()
                }
            });
        }else {
            document.querySelector('#acceptedConditionBtn span').hidden = true;
            let toastError = new bootstrap.Toast(document.getElementById('toastError'));
            toastError.show();
        }
    });
    //
    

    // Écouter le changement de sélection pour le thème
     $('#theme').on('change', function() {
    //     // Récupérer l'option sélectionnée
         var selectedOption = $(this).find('option:selected');
         var value = $(this).val();
         var discipline = selectedOption.data('discipline');
         var text = selectedOption.text();
         $('#subject').val(text);
     });
    //
    // Fonction pour mettre à jour le sujet en fonction de la sélection du thème
    function updateSubject() {
        // Récupérer l'option sélectionnée
        var selectedOption = $('#theme').find('option:selected');
        var text = selectedOption.text();
        // Mettre à jour le champ #subject avec le texte de l'option sélectionnée
      
    }
    // Écouter le changement de sélection pour le thème
    $('#theme').on('change', updateSubject);
    updateSubject();





    // Fonction pour mettre à jour les éléments en fonction de l'option sélectionnée
    function updateElements() {
        // Récupérer l'option sélectionnée
        let selectedOption = $('#typeService').find('option:selected');
        let service = selectedOption.text();
        montant = selectedOption.data('montant');
        document.getElementById('amount').value = montant;

        document.getElementById('montant').innerText = `${montant} F cfa(XOF)`;
       // console.log(montant);
     /*if (service.includes("Rédaction complète") || service.includes("Protocole")) {
            document.getElementById('check_choose').checked = true;
            showElement( document.getElementById('check_choose'));
            document.querySelector('label[for="check_choose"]').style.display = 'block';
            showElement( document.getElementById('div_theme'));
            document.getElementById('div_subject').hidden=true;
        }else{
            document.getElementById('check_choose').checked = false;
            hideElement( document.getElementById('check_choose'));
            document.querySelector('label[for="check_choose"]').style.display = 'none';
            hideElement( document.getElementById('div_theme'));
            document.getElementById('div_subject').hidden=false;
        }*/
    }
    
   
   
    function updateMontant() {
        // Récupérer l'option sélectionnée
        let selectedOption = $('#typeService').find('option:selected');
        let service = selectedOption.text();
        montant = selectedOption.data('montant');
        document.getElementById('amount').value = montant;

        document.getElementById('montant').innerText = `${montant} F cfa(XOF)`;
       // console.log(montant);

       var codeAf = $('#codeAf').val();

                    // 3. Calcul de la date minimale selon le type de service
                const today = new Date();
                const minDays = parseInt($('#serviceType').find('option:selected').data('days'));
                const minDate = new Date(today);
                minDate.setDate(today.getDate() + minDays);
                
                // 4. Formatage YYYY-MM-DD
                const formattedDate = minDate.toISOString().split('T')[0];
                
                // 5. Application de la date minimale
                const dateInput = document.getElementById('deadline');
                dateInput.min = formattedDate;
                
                // 6. Réinitialisation si date actuelle invalide
                if (!dateInput.value || new Date(dateInput.value) < minDate) {
                    dateInput.value = formattedDate;
                }
                    
       let montantFinal=montant;
       let montantReduit=0;
      
       $('#promo-message').removeClass('text-success text-danger text-warning');
            if(serviceType === "vip" ) { 
                montant = montant*1.5; 
                 }
                 else{
                montant = montant;
                 }
           if (codesPromoValides.includes(codeAf) ) {
           // Vérifie la valeur de 'montant'
           
               let reduction = 0.30;  // Par exemple, 30% de réduction
              montantFinal = montant*(1 - reduction);
               montantFinal = Math.round(montantFinal / 100) * 100;
               let montantReduit =montant- montantFinal     ;  // Par exemple, 30% de réduction


               $('#promo-message').text(`🎉 Code promo "${codeAf}" valide ! Réduction de 30% appliquée.`)
               .addClass('text-success');
               $('#montant').text(` ${montant} F cfa(XOF)`);
               $('#montantReduit').text(` ${montantReduit} F cfa(XOF)`);
               $('#montantFinal').text(` ${montantFinal} F cfa(XOF)`);

           } 
           else if (codeAf === "1000") {
            // Aucun code promo saisi, applique une réduction de 1000
            montantFinal = montant;
            montantReduit = 0; // La réduction appliquée est fixe ici (1000)
                $('#montant').text(` ${montant} F cfa(XOF)`);
            $('#montantFinal').text(` ${montant} F cfa(XOF)`);
            $('#promo-message').text("✅ Code promo 1000 valide ! Aucune réduction appliquée. Code standard utilisé.")
            .addClass('text-warning');}
           else {

               $('#promo-message').text('🚫 Code promo  invalide. Aucun changement dans le montant.')
               .addClass('text-danger');
               montantReduit =0 ;
                montantFinal = montant;
                $('#montant').text(` ${montant} F cfa(XOF)`);
                $('#montantFinal').text(` ${montantFinal} F cfa(XOF)`);
               $('#montantReduit').text(`${montantReduit} F cfa(XOF)`);
           }
           




       
    }
   
        // Événement 'input' sur le champ #codeAf
            $('#codeAf').on('input', function() {
                let codeSaisi = $(this).val(); // Code promo saisi
                updateMontant();
                // Mise à jour du montant final basé sur le code promo
            });
                //Écouter l'événement change
                $('#typeService').on('change', function() {
                    updateElements();
                
                updateMontant();
                });

            $('#serviceType').change(function() {
            serviceType = $(this).val();
           updateMontant();
        });
            //download file final





});

