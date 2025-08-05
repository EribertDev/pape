document.addEventListener("DOMContentLoaded", function() {

    
    // Fonction pour calculer les coûts
    function calculateCosts() {
        const pageCount = parseInt($('input[name="page_count"]').val()) || 0;
        const copyCount = parseInt($('input[name="copy_count"]').val()) || 0;
        const isStudent = $('input[name="student_tariff"]').is(':checked');
        const deliveryMode = $('select[name="delivery_mode"]').val();
        const color = $('select[name="color"]').val();
        const binding = $('input[name="binding"]').is(':checked');
        const lamination = $('input[name="lamination"]').is(':checked');
        const fileUploadContainer= document.getElementById('fileUploadContainer');
        
        // Calcul du coût
        let costPerPage = isStudent ? 50 : 100; // FCFA
        if (color === 'couleur') costPerPage *= 1.5;
        
        let orderCost = pageCount * copyCount * costPerPage;
        
        // Ajout des coûts supplémentaires
        if (binding) orderCost += 1000;
        if (lamination) orderCost += 500;
        
        const deliveryCost = deliveryMode === 'Domicile' ? 1000 : 500; // FCFA
        const totalCost = orderCost + deliveryCost;
        
        // Mise à jour de l'UI
        $('#orderCost').text(orderCost.toLocaleString('fr-FR') + ' FCFA');
        $('#deliveryCost').text(deliveryCost.toLocaleString('fr-FR') + ' FCFA');
        $('#totalCost').text(totalCost.toLocaleString('fr-FR') + ' FCFA');
    }
    
    // Gestion du changement de mode de livraison
    $('#deliveryMode').change(function() {
        if ($(this).val() === 'Domicile') {
            $('#homeDeliverySection').show();
            $('#relayPointSection').hide();
        } else {
            $('#homeDeliverySection').hide();
            $('#relayPointSection').show();
        }
        calculateCosts();
    });
    
    // Gestion de la reliure
    $('input[name="binding"]').change(function() {
        $('#bindingTypeSection').toggle(this.checked);
        calculateCosts();
    });
    
    // Gestion de la plastification
    $('input[name="lamination"]').change(function() {
        calculateCosts();
    });
    
    $('#fileUploadContainer').on('click', function(e) {
        e.stopPropagation();
        $('#fileInput').click();
    });

    $('#fileInput').on('click', function(e) {
        e.stopPropagation();
    });
    
    $('#fileInput').on('change', function(e) {
        if (this.files && this.files[0]) {
            const fileName = this.files[0].name;
            const fileSize = (this.files[0].size / 1024 / 1024).toFixed(2); // en Mo
            $('#fileInfo').html(`
                <strong>${fileName}</strong><br>
                Taille: ${fileSize} MB
            `);
            $('#fileUploadContainer').css({
                'border-color': '#2eca7f',
                'background-color': '#e6f9f2'
            });
        }
    });
    
    // Permettre le drag and drop
    $('#fileUploadContainer').on('dragover', function(e) {
        e.preventDefault();
        $(this).css({
            'border-color': '#2eca7f',
            'background-color': '#e6f9f2'
        });
    });
    
    $('#fileUploadContainer').on('dragleave', function(e) {
        e.preventDefault();
        $(this).css({
            'border-color': '#dee2e6',
            'background-color': '#f8f9fa'
        });
    });
    
    $('#fileUploadContainer').on('drop', function(e) {
        e.preventDefault();
        const files = e.originalEvent.dataTransfer.files;
        if (files.length) {
            $('#fileInput').prop('files', files);
            const fileName = files[0].name;
            const fileSize = (files[0].size / 1024 / 1024).toFixed(2); // en Mo
            $('#fileInfo').html(`
                <strong>${fileName}</strong><br>
                Taille: ${fileSize} MB
            `);
            $(this).css({
                'border-color': '#2eca7f',
                'background-color': '#e6f9f2'
            });
        }
    });
    
    // Écouteurs pour les champs affectant les coûts
    $('input[name="page_count"], input[name="copy_count"], input[name="student_tariff"], select[name="color"]').on('input change', calculateCosts);
    
    // Soumission du formulaire
    $('#reprographyForm').on('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        $.ajax({
            url: '/reprography/store',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                // Afficher un loader
                Swal.fire({
                    title: 'Traitement en cours',
                    html: 'Enregistrement de votre commande...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Commande enregistrée!',
                    html: `
                        <div class="text-center">
                            <i class="fas fa-check-circle text-success mb-3" style="font-size: 4rem;"></i>
                            <p class="fs-5">${response.message}</p>
                            <p class="mt-3">ID de commande: <strong>#${response.order_id}</strong></p>
                            <div class="mt-4 bg-light p-3 rounded">
                                <h5>Récapitulatif</h5>
                                <p class="mb-1">Coût commande: <strong>${$('#orderCost').text()}</strong></p>
                                <p class="mb-1">Livraison: <strong>${$('#deliveryCost').text()}</strong></p>
                                <p class="mb-0">Total: <strong>${$('#totalCost').text()}</strong></p>
                            </div>
                        </div>
                    `,
                    confirmButtonText: 'Fermer',
                    confirmButtonColor: '#2eca7f',
                    allowOutsideClick: false
                }).then(() => {
                    // Réinitialiser le formulaire
                    $('#reprographyForm')[0].reset();
                    $('#fileInfo').html('Formats acceptés: PDF, DOC, DOCX, JPG, PNG');
                    $('#fileUploadContainer').css({
                        'border-color': '#dee2e6',
                        'background-color': '#f8f9fa'
                    });
                    calculateCosts();
                });
            },
            error: function(xhr) {
                let errorMessage = 'Une erreur est survenue';
                
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    errorMessage = '';
                    Object.values(xhr.responseJSON.errors).forEach(errors => {
                        errors.forEach(error => {
                            errorMessage += `${error}<br>`;
                        });
                    });
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    html: errorMessage,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#d33'
                });
            }
        });
    });
    
    // Initialiser les calculs
    calculateCosts();

});