@extends('clients.master-1')

@section('extra-style')
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{asset('client/js-simple-loader-main/loader.css')}}" />
    <script  src="{{asset('client/js-simple-loader-main/loader.js')}}"  ></script>
    <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2eca7f;;
            --secondary: #3f37c9;
            --accent: #4cc9f0;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #4ade80;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
            min-height: 100vh;
           
            align-items: center;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .internship-form {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        
        .internship-form:hover {
            transform: translateY(-5px);
        }
        
        .form-header {
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        
        .form-header h2 {
            font-weight: 700;
            margin-bottom: 5px;
            letter-spacing: 0.5px;
        }
        
        .form-header p {
            opacity: 0.9;
            font-size: 1.1rem;
        }
        
        .form-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            color: rgba(255, 255, 255, 0.8);
        }
        
        .form-content {
            padding: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }
        
        .form-label i {
            margin-right: 10px;
            color: var(--primary);
            width: 20px;
        }
        
        .form-control, .form-select, .form-control-file {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }
        
        .form-control::placeholder {
            color: #a0aec0;
        }
        
        .btn-submit {
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
            border: none;
            color: white;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px auto 0;
            width: 100%;
            max-width: 250px;
        }
        
        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.4);
        }
        
        .btn-submit:active {
            transform: translateY(0);
        }
        
        .file-upload {
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }
        
        .file-upload input[type="file"] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            cursor: pointer;
            display: block;
        }
        
        .file-info {
            display: block;
            margin-top: 8px;
            font-size: 0.85rem;
            color: #718096;
        }
        
        .required-field::after {
            content: " *";
            color: #e53e3e;
        }
        
        .progress-container {
            margin-top: 30px;
            padding: 15px;
            background-color: #f8fafc;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }
        
        .progress-bar {
            background: linear-gradient(90deg, var(--accent) 0%, var(--primary) 100%);
        }
        
        .form-note {
            text-align: center;
            margin-top: 20px;
            color: #718096;
            font-size: 0.9rem;
        }
        
        .form-note a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }
        
        .form-note a:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            .form-content {
                padding: 20px;
            }
            
            .form-header {
                padding: 20px 15px;
            }
        }
    </style>
@endsection

@section('page-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class=" col-md-10 col-sm-12">
                <div class="internship-form">
                    <div class="form-header">
                        <div class="form-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h2>Demande de Stage</h2>
                        <p>Remplissez le formulaire pour soumettre votre candidature</p>
                    </div>
                    
                    <div class="form-content">
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-info-circle me-2"></i> Tous les champs marqués d'un astérisque (*) sont obligatoires.
                        </div>
                        
                        <form id="internshipForm">
                            <div class="progress-container">
                                <p class="mb-2"><strong>Progression du formulaire:</strong></p>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label required-field">
                                            <i class="fas fa-user"></i> Nom
                                        </label>
                                        <input type="text" class="form-control" placeholder="Votre nom" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label required-field">
                                            <i class="fas fa-user"></i> Prénom
                                        </label>
                                        <input type="text" class="form-control" placeholder="Votre prénom" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label required-field">
                                            <i class="fas fa-envelope"></i> Email
                                        </label>
                                        <input type="email" class="form-control" placeholder="exemple@email.com" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label required-field">
                                            <i class="fas fa-phone"></i> Téléphone
                                        </label>
                                        <input type="tel" class="form-control" placeholder="+33 6 12 34 56 78" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label required-field">
                                    <i class="fas fa-graduation-cap"></i> Établissement
                                </label>
                                <input type="text" class="form-control" placeholder="Nom de votre école/université" required>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label required-field">
                                            <i class="fas fa-book"></i> Domaine d'études
                                        </label>
                                        <select class="form-select" required>
                                            <option value="" selected disabled>Choisissez votre domaine</option>
                                            <option>Informatique</option>
                                            <option>Marketing</option>
                                            <option>Finance</option>
                                            <option>Ressources Humaines</option>
                                            <option>Ingénierie</option>
                                            <option>Design</option>
                                            <option>Santé</option>
                                            <option>Autre</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label required-field">
                                            <i class="fas fa-layer-group"></i> Niveau d'études
                                        </label>
                                        <select class="form-select" required>
                                            <option value="" selected disabled>Sélectionnez votre niveau</option>
                                            <option>Bac</option>
                                            <option>Bac+2</option>
                                            <option>Bac+3</option>
                                            <option>Bac+4</option>
                                            <option>Bac+5 et plus</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label required-field">
                                            <i class="fas fa-calendar-alt"></i> Type de stage
                                        </label>
                                        <select class="form-select" required>
                                            <option value="" selected disabled>Type de stage</option>
                                            <option>Stage d'été</option>
                                            <option>Stage de fin d'études</option>
                                            <option>Stage alterné</option>
                                            <option>Stage professionnel</option>
                                            <option>Stage de recherche</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label required-field">
                                            <i class="fas fa-clock"></i> Durée (semaines)
                                        </label>
                                        <input type="number" class="form-control" placeholder="Durée en semaines" min="4" max="52" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label required-field">
                                    <i class="fas fa-calendar-check"></i> Période souhaitée
                                </label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="date" class="form-control" placeholder="Date de début" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="date" class="form-control" placeholder="Date de fin" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label required-field">
                                            <i class="fas fa-file-pdf"></i> CV (PDF)
                                        </label>
                                        <div class="file-upload btn btn-outline-primary w-100">
                                            <i class="fas fa-cloud-upload-alt me-2"></i>Télécharger le fichier
                                            <input type="file" class="form-control-file" accept=".pdf,.doc,.docx" required>
                                        </div>
                                        <span class="file-info">Taille max: 5MB (PDF, DOC, DOCX)</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="fas fa-file-alt"></i> Lettre de motivation
                                        </label>
                                        <div class="file-upload btn btn-outline-primary w-100">
                                            <i class="fas fa-cloud-upload-alt me-2"></i>Télécharger le fichier
                                            <input type="file" class="form-control-file" accept=".pdf,.doc,.docx">
                                        </div>
                                        <span class="file-info">Optionnel (PDF, DOC, DOCX)</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label required-field">
                                    <i class="fas fa-comment-alt"></i> Message
                                </label>
                                <textarea class="form-control" rows="5" placeholder="Présentez-vous et expliquez pourquoi vous souhaitez effectuer un stage dans notre entreprise..." required></textarea>
                            </div>
                            
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="consentCheck" required>
                                    <label class="form-check-label" for="consentCheck">
                                        J'autorise le traitement de mes données personnelles conformément à la politique de confidentialité.
                                    </label>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn-submit">
                                <i class="fas fa-paper-plane me-2"></i> Soumettre la demande
                            </button>
                            
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script>
        // Animation de progression
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('internshipForm');
            const progressBar = document.querySelector('.progress-bar');
            const formGroups = form.querySelectorAll('.form-group');
            const totalGroups = formGroups.length;
            
            // Mise à jour de la barre de progression
            function updateProgress() {
                let completed = 0;
                
                formGroups.forEach(group => {
                    const inputs = group.querySelectorAll('input, select, textarea');
                    let groupCompleted = false;
                    
                    inputs.forEach(input => {
                        if (input.type !== 'file' && input.value.trim() !== '') {
                            groupCompleted = true;
                        }
                        if (input.type === 'checkbox' && input.checked) {
                            groupCompleted = true;
                        }
                    });
                    
                    if (groupCompleted) completed++;
                });
                
                const progress = Math.min(100, Math.round((completed / totalGroups) * 100));
                progressBar.style.width = `${progress}%`;
                progressBar.setAttribute('aria-valuenow', progress);
                progressBar.textContent = `${progress}%`;
            }
            
            // Écouteurs d'événements pour les champs du formulaire
            form.querySelectorAll('input, select, textarea').forEach(input => {
                input.addEventListener('input', updateProgress);
                input.addEventListener('change', updateProgress);
            });
            
            // Initialisation de la progression
            updateProgress();
            
            // Gestion de la soumission du formulaire
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Animation de soumission
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Envoi en cours...';
                submitBtn.disabled = true;
                
                // Simulation d'envoi
                setTimeout(() => {
                    alert('Votre demande de stage a été soumise avec succès ! Nous vous contacterons bientôt.');
                    form.reset();
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                    updateProgress();
                }, 2000);
            });
            
            // Animation pour les uploads de fichiers
            const fileInputs = document.querySelectorAll('.form-control-file');
            fileInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const fileName = this.files[0] ? this.files[0].name : 'Aucun fichier sélectionné';
                    const fileInfo = this.closest('.form-group').querySelector('.file-info');
                    fileInfo.textContent = fileName;
                    
                    if (this.files[0]) {
                        fileInfo.innerHTML = `<i class="fas fa-check-circle text-success me-1"></i> ${fileName}`;
                    }
                    
                    updateProgress();
                });
            });
        });
    </script>
@endsection