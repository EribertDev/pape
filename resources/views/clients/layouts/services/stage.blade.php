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
                        
                        <form id="internshipForm" class="form border border-1 border-opacity-50 p-3" enctype="multipart/form-data">
                        @csrf
                        @if (Auth::check())
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label required-field">
                                            <i class="fas fa-user"></i> Nom
                                        </label>
                                        <input type="text" class="form-control" value="{{session('clientInfo') ->fist_name }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label required-field">
                                            <i class="fas fa-user"></i> Prénom
                                        </label>
                                        <input type="text" class="form-control" value="{{session('clientInfo') ->last_name }}" disabled>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label required-field">
                                            <i class="fas fa-envelope"></i> Email
                                        </label>
                                        <input type="email" class="form-control" value="{{Auth::user()->email}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label required-field">
                                            <i class="fas fa-phone"></i> Téléphone
                                        </label>
                                        <input type="tel" class="form-control" value="{{session('clientInfo')->phone_number }}" disabled>
                                    </div>
                                </div>
                            </div>
                        @else 
                        <h3 class="text-center ">Veuillez vous connecter pour voir vos informations personnelles  </h3>
                        @endif
                        <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="hasBinome">
                                <label class="form-check-label" for="hasBinome">Je suis en binôme</label>
                            </div>
                        </div>
                    </div>

                            <!-- Champ Binôme (caché par défaut) -->
                            <div id="binomeField" class="row mb-3" style="display: none;">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="binome" class="form-label">
                                            <i class="fas fa-user-friends"></i> Nom complet du binôme
                                        </label>
                                        <input type="text" class="form-control" id="binome" name="binome" placeholder="Nom et prénom du binôme">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label required-field">
                                    <i class="fas fa-graduation-cap"></i>Université/Établissement
                                </label>
                                <input type="text" class="form-control" id="university" name="university" placeholder="Nom de votre école/université" required>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label required-field">
                                            <i class="fas fa-book"></i> Domaine d'études
                                        </label>
                                        <select class="form-select" id="domaine" name="domaine" required>
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
                                        <select class="form-select" id="level" name="level" required>
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
                                     
                                        <label for="specialite" class="form-label required-field">Filière/Spécialité</label>
                                        <input type="text" class="form-control" id="specialite" name="specialite" placeholder="Spécialité ou filière" required>
                                      
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label required-field">
                                            <i class="fas fa-clock"></i> Durée (mois)
                                        </label>
                                        <input type="number" class="form-control" id="duration" name="duration" placeholder="Durée en mois " min="1" max="6" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                               
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="country" class="fw-bold">Commune </label>
                                                                                                                    
                                        <select name="commune" id="commune"  class="form-control">
                                                <option value="" disabled selected>-- Sélectionnez une Commune --</option>
                                                @foreach ($departements as $departement => $communes)
                                                    <optgroup label="{{ $departement }}">
                                                        @foreach ($communes as $commune)
                                                            <option value="{{ $commune }}">{{ $commune }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            
                                                
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fieldlabels  fw-bold" for="structure">Stucture</label>
                                        <select name="structure" id="structure"  class="form-control">
                                            <option value="" selected disabled>Quelles structure désirez vous</option>
                                            
                                                <option  value="administration_publique">Administration Publique</option>
                                                <option  value="adlinistration_privee"> Administration Privée</option>
                                                <option  value="formation_sanitaire"> Formation Sanitaire</option>
                                                <option  value="institution_microfinance"> Institution de Microfinance</option>
                                                <option  value="anyway"> N'importe quelle structure</option>
                                        
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                              
                                <div class="">
                                    <div class="form-group" id="fileInput">
                                        <label class="form-label">
                                            <i class="fas fa-file-alt"></i> Lettre de recommandation
                                        </label>
                                        <div class="file-upload btn btn-outline-primary w-100" >
                                            <i class="fas fa-cloud-upload-alt me-2"></i>Télécharger le fichier
                                            <input type="file" id="recommendation_letter" name="recommendation_letter" class="form-control-file" accept=".pdf,.doc,.docx">
                                        </div>
                                        <span class="file-info">Optionnel (PDF, DOC, DOCX)</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label ">
                                    <i class="fas fa-comment-alt"></i> Message
                                </label>
                                <textarea class="form-control" id="message" name="message" rows="5" placeholder="..." ></textarea>
                            </div>
                            
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="consentCheck" required>
                                    <label class="form-check-label" for="consentCheck">
                                        J'autorise le traitement de mes données personnelles conformément à la politique de confidentialité.
                                    </label>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn-submit" id ="submitBtn">
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
        

        
          
            const csrfToken = document.querySelector('input[name="_token"]').value;

            const form = document.getElementById('internshipForm');
            const submitBtn = document.getElementById('submitBtn');
            // Gestion de la soumission du formulaire
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Envoi en cours...';
                submitBtn.disabled = true;
             
                    if (typeof isAuthenticated == 'undefined' ){
                        $('#loginModal').modal('show');
                    }
                
                else{

              
                    console.log(form);
                $.ajax({
                headers: {
                    'Accept': 'application/json;charset=utf-8',
                    'X-CSRF-TOKEN': csrfToken
                },
                url: '{{ route('stage.store') }}',
                type:'POST',
                data: new FormData(form),
                processData: false,
                contentType: false,
                dataType: 'JSON',

                success: function (response) {
                    submitBtn.innerHTML = '<i class="fas fa-check-circle me-2"></i> Demande envoyée';
                    submitBtn.classList.add('btn-success');
                    if(response.success===true){
                        
                        window.location.href = "/stage/finish";
                    
                    }
                   
                },
                error: function (xhr, status, error) {
                    document.getElementById('submitBtn').hidden = false;
                    
                },
                complete: function () {
                    Loader.close()
                }
            });
              }
         
                
               
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
                    
                  
                });
            });



                        document.getElementById('hasBinome').addEventListener('change', function() {
                const binomeField = document.getElementById('binomeField');
                if (this.checked) {
                    binomeField.style.display = 'block';
                    document.getElementById('binome').setAttribute('required', 'required');
                } else {
                    binomeField.style.display = 'none';
                    document.getElementById('binome').removeAttribute('required');
                    document.getElementById('binome').value = '';
                }
            });
        });
    </script>
@endsection