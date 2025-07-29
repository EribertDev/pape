<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande de Formation</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
        .modal-header {
            background: linear-gradient(135deg, #2eca7f, #1a2d62);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
        }
        .modal-title {
            font-weight: 700;
        }
        .modal-body {
            padding: 25px;
        }
        .form-label {
            font-weight: 600;
            color: #1a2d62;
            margin-bottom: 8px;
        }
        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #2eca7f;
            box-shadow: 0 0 0 0.25rem rgba(46, 202, 127, 0.25);
        }
        .btn-submit {
            background: linear-gradient(135deg, #2eca7f, #1a2d62);
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            width: 100%;
            margin-top: 15px;
        }
        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(46, 202, 127, 0.4);
        }
        .required-star {
            color: #e74c3c;
            font-size: 18px;
            vertical-align: middle;
        }
        .info-icon {
            color: #2eca7f;
            margin-right: 8px;
            font-size: 18px;
        }
        .form-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .form-section-title {
            font-weight: 700;
            color: #1a2d62;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>

<!-- Bouton pour ouvrir le modal -->
<div class="container my-5">
    <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-lg btn-primary" data-bs-toggle="modal" data-bs-target="#formationModal">
            <i class="fas fa-graduation-cap me-2"></i>Demander une formation
        </button>
    </div>
</div>

<!-- Modal de demande de formation -->
<div class="modal fade" id="formationModal" tabindex="-1" aria-labelledby="formationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formationModalLabel">
                    <i class="fas fa-chalkboard-teacher me-2"></i>Demande de Formation
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formationForm">
                    <div class="form-section">
                        <h6 class="form-section-title">
                            <i class="fas fa-user-circle info-icon"></i>Informations Personnelles
                        </h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName" class="form-label">Prénom <span class="required-star">*</span></label>
                                <input type="text" class="form-control" id="firstName" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName" class="form-label">Nom <span class="required-star">*</span></label>
                                <input type="text" class="form-control" id="lastName" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email <span class="required-star">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Téléphone <span class="required-star">*</span></label>
                                <input type="tel" class="form-control" id="phone" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h6 class="form-section-title">
                            <i class="fas fa-book info-icon"></i>Détails de la Formation
                        </h6>
                        <div class="mb-3">
                            <label for="formationType" class="form-label">Type de Formation <span class="required-star">*</span></label>
                          <select class="form-select" id="formationType" required>
                            <option value="" selected disabled>Sélectionnez un type</option>
                            <option value="secretariat">Secrétariat bureautique</option>
                            <option value="graphisme">Graphisme</option>
                            <option value="dev_web">Développement web</option>
                            <option value="programmation">Programmation</option>
                            <option value="stat_info">Statistique et Informatique</option>
                            <option value="epidemiologie">Épidémiologie</option>
                            <option value="redaction_admin">Rédaction administrative</option>
                            <option value="suivi_eval">Planification, Suivi-Evaluation</option>
                            <option value="maintenance">Maintenance informatique</option>
                            <option value="reparation_pc">Réparation d'ordinateur</option>
                            <option value="logiciel_stats">Logiciel Statistiques (SPSS, Stata, R...)</option>
                            <option value="dev_android">Développement d'application android</option>
                            <option value="etats_financiers">Réalisation d'états financiers</option>
                            <option value="systeme_info">Système d'Information</option>
                        </select>
                        </div>
                        <div class="mb-3">
                            <label for="formationTheme" class="form-label">Thème de la Formation <span class="required-star">*</span></label>
                            <input type="text" class="form-control" id="formationTheme" placeholder="Ex: Développement Web, Gestion de projet..." required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="participants" class="form-label">Nombre de Participants <span class="required-star">*</span></label>
                                <input type="number" class="form-control" id="participants" min="1" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="duration" class="form-label">Durée Estimée (jours) <span class="required-star">*</span></label>
                                <input type="number" class="form-control" id="duration" min="1" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="datePreference" class="form-label">Dates Préférées</label>
                            <input type="text" class="form-control" id="datePreference" placeholder="Ex: Semaine du 15 octobre">
                        </div>
                    </div>

                    <div class="form-section">
                        <h6 class="form-section-title">
                            <i class="fas fa-file-alt info-icon"></i>Informations Complémentaires
                        </h6>
                        <div class="mb-3">
                            <label for="objectives" class="form-label">Objectifs de la Formation <span class="required-star">*</span></label>
                            <textarea class="form-control" id="objectives" rows="3" required placeholder="Décrivez les objectifs que vous souhaitez atteindre..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="additionalInfo" class="form-label">Informations Complémentaires</label>
                            <textarea class="form-control" id="additionalInfo" rows="3" placeholder="Toute autre information utile..."></textarea>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="terms" required>
                            <label class="form-check-label" for="terms">
                                J'accepte les <a href="#" class="text-primary">conditions d'utilisation</a> et la <a href="#" class="text-primary">politique de confidentialité</a> <span class="required-star">*</span>
                            </label>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-submit">
                            <i class="fas fa-paper-plane me-2"></i>Soumettre la demande
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Gestion de la soumission du formulaire
        $('#formationForm').on('submit', function(e) {
            e.preventDefault();
            
            // Validation
            let isValid = true;
            $('#formationForm input, #formationForm select, #formationForm textarea').each(function() {
                if ($(this).prop('required') && !$(this).val()) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            
            if ($('#terms').is(':checked') === false) {
                isValid = false;
                $('#terms').next().addClass('text-danger');
            } else {
                $('#terms').next().removeClass('text-danger');
            }
            
            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Champs manquants',
                    text: 'Veuillez remplir tous les champs obligatoires',
                    confirmButtonColor: '#2eca7f'
                });
                return;
            }
            
            // Collecter les données du formulaire
            const formData = {
                firstName: $('#firstName').val(),
                lastName: $('#lastName').val(),
                email: $('#email').val(),
                phone: $('#phone').val(),
                formationType: $('#formationType').val(),
                formationTheme: $('#formationTheme').val(),
                participants: $('#participants').val(),
                duration: $('#duration').val(),
                datePreference: $('#datePreference').val(),
                objectives: $('#objectives').val(),
                additionalInfo: $('#additionalInfo').val(),
                _token: '{{ csrf_token() }}' // Important pour la protection CSRF
            };
            
            // Envoyer les données au serveur
            $.ajax({
                type: 'POST',
                url: '{{ route("formation.send") }}',
                data: formData,
                success: function(response) {
                    // Fermer le modal
                    $('#formationModal').modal('hide');
                    
                    // Réinitialiser le formulaire
                    $('#formationForm')[0].reset();
                    
                    // Afficher la notification de succès
                    Swal.fire({
                        icon: 'success',
                        title: 'Demande envoyée!',
                        html: `
                            <div class="text-center">
                                <i class="fas fa-check-circle text-success mb-3" style="font-size: 4rem;"></i>
                                <p>Votre demande de formation a été envoyée avec succès.</p>
                                <p class="small">Vous recevrez une confirmation par email dans quelques instants.</p>
                            </div>
                        `,
                        showConfirmButton: true,
                        confirmButtonColor: '#2eca7f',
                        confirmButtonText: 'Fermer'
                    });
                    window.location.reload(); // Recharger la page pour mettre à jour le contenu
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Une erreur est survenue lors de l\'envoi de votre demande. Veuillez réessayer.',
                        confirmButtonColor: '#2eca7f'
                    });
                }
               
            });
        });
        
        // Gestion des erreurs de validation
        $('input, select, textarea').on('input', function() {
            if ($(this).prop('required') && $(this).val()) {
                $(this).removeClass('is-invalid');
            }
        });
    });
</script>
</body>
</html>