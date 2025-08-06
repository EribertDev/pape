document.addEventListener("DOMContentLoaded", function() {

      function calculateCosts() {
        const pageCount = parseInt($('input[name="page_count"]').val()) || 0;
        const copyCount = parseInt($('input[name="copy_count"]').val()) || 0;
        const isStudent = $('input[name="student_tariff"]').is(':checked');
        const deliveryMode = $('select[name="delivery_mode"]').val();
        const color = $('select[name="color"]').val();
        const binding = $('input[name="binding"]').is(':checked');
        const lamination = $('input[name="lamination"]').is(':checked');
        const commune = $('#communeSelect').val();
        
        // Calcul du coût
        let costPerPage = isStudent ? 50 : 100; // FCFA
        if (color === 'couleur') costPerPage *= 1.5;
        
        let orderCost = pageCount * copyCount * costPerPage;
        
        // Ajout des coûts supplémentaires
        if (binding) orderCost += 1000;
        if (lamination) orderCost += 500;
        
        // Coût de livraison basé sur la commune
        let deliveryCost = 1000; // FCFA par défaut
        if (commune === 'Cotonou' || commune === 'Calavi') {
            deliveryCost = 500;
        }
        
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
    
    // Gestion de l'upload de fichier
   $('#fileUploadContainer').on('click', function(e) {
    e.stopPropagation();
    $('#fileInput').click();
    });

    $('#fileInput').on('click', function(e) {
        e.stopPropagation();
    });
    
    $('#fileInput').on('change', function(e) {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            const fileName = file.name;
            const fileSize = (file.size / 1024 / 1024).toFixed(2); // en Mo
            $('#fileInfo').html(`
                <strong>${fileName}</strong><br>
                Taille: ${fileSize} MB
            `);
            $('#fileUploadContainer').css({
                'border-color': '#2eca7f',
                'background-color': '#e6f9f2'
            });
            
            // Réinitialiser le bouton de détection
            $('#autoDetectBtn').prop('disabled', false);
            $('#pageCountInfo').text('Cliquez sur "Détecter" pour compter les pages');
        }
    });
    
    // Détection du nombre de pages pour les fichiers PDF
    $('#autoDetectBtn').on('click', function() {
        const fileInput = document.getElementById('fileInput');
        if (!fileInput.files || !fileInput.files[0]) {
            Swal.fire('Erreur', 'Veuillez d\'abord sélectionner un fichier', 'error');
            return;
        }
        
        const file = fileInput.files[0];
        if (file.type !== 'application/pdf') {
            Swal.fire('Format non supporté', 'La détection automatique ne fonctionne que pour les fichiers PDF', 'warning');
            return;
        }
        
        const fileReader = new FileReader();
        fileReader.onload = function() {
             // Initialisation de PDF.js worker
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';
            
            const typedarray = new Uint8Array(this.result);
            
            // Charger le document PDF avec pdf.js
            pdfjsLib.getDocument(typedarray).promise.then(function(pdf) {
                // Obtenir le nombre de pages
                const numPages = pdf.numPages;
                $('#pageCount').val(numPages).trigger('input');
                $('#pageCountInfo').html(`
                    <span class="text-success">
                        <i class="fas fa-check-circle"></i> ${numPages} pages détectées
                    </span>
                `);
                $('#autoDetectBtn').prop('disabled', true);
                calculateCosts();
            }).catch(function(error) {
                console.error('Erreur PDF.js:', error);
                Swal.fire('Erreur', 'Impossible de lire le fichier PDF', 'error');
            });
        };
        
        fileReader.readAsArrayBuffer(file);
    });
    
    // Obtenir la localisation GPS
    $('#getLocationBtn').on('click', function() {
        if (!navigator.geolocation) {
            Swal.fire('Non supporté', 'La géolocalisation n\'est pas supportée par votre navigateur', 'warning');
            return;
        }
        
        $(this).html('<i class="fas fa-spinner fa-spin me-1"></i> Localisation...').prop('disabled', true);
        
        navigator.geolocation.getCurrentPosition(
            function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                $('#gpsLocation').val(`${lat.toFixed(6)}, ${lng.toFixed(6)}`);
                
                // Afficher un aperçu de la carte
                const mapImg = `https://maps.googleapis.com/maps/api/staticmap?center=${lat},${lng}&zoom=15&size=600x200&markers=color:red%7C${lat},${lng}&key=YOUR_API_KEY`;
                $('#mapPreview').html(`<img src="${mapImg}" alt="Votre position">`);
                
                $('#getLocationBtn').html('<i class="fas fa-location-crosshairs me-1"></i> Ma position').prop('disabled', false);
            },
            function(error) {
                let errorMessage = "Impossible d'obtenir votre position";
                switch(error.code) {
                    case error.PERMISSION_DENIED:
                        errorMessage = "Permission refusée. Veuillez activer la géolocalisation dans vos paramètres.";
                        break;
                    case error.POSITION_UNAVAILABLE:
                        errorMessage = "Les informations de localisation ne sont pas disponibles.";
                        break;
                    case error.TIMEOUT:
                        errorMessage = "La demande de localisation a expiré.";
                        break;
                }
                Swal.fire('Erreur', errorMessage, 'error');
                $('#getLocationBtn').html('<i class="fas fa-location-crosshairs me-1"></i> Ma position').prop('disabled', false);
            }
        );
    });
    
    // Écouteurs pour les champs affectant les coûts
    $('input[name="page_count"], input[name="copy_count"], input[name="student_tariff"], select[name="color"], #communeSelect').on('input change', calculateCosts);
    
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
                    $('#mapPreview').html('<i class="fas fa-map-marked-alt text-muted" style="font-size: 3rem;"></i>');
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