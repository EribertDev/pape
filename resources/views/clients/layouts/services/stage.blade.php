@extends('clients.master-1')

@section('extra-style')
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{asset('client/js-simple-loader-main/loader.css')}}" />
    <link rel="stylesheet" href="{{asset('clients\assets\css\stage.css')}}" />
    <script  src="{{asset('client/js-simple-loader-main/loader.js')}}"  ></script>
    <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
      
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
                                            <option>Économie </option>
                                            <option>Gestion</option>
                                            <option>Santé Publique</option>
                                            <option>Soins Infirmiers et assimilés</option>
                                            <option>Gestion de Projets</option>
                                            <option>Entrepreneuriat</option>
                                            <option>Communication</option>
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
                                            <option value="Licence">Licence</option>
                                             <option value="Master">Master</option>
                                            <option value="Doctorat">Doctorat</option>
                                            <option value="Autre">Autre</option>
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
                                        <label for="country" class="fw-bold">Commune souhaitée </label>
                                                                                                                    
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
                                        <label class="fieldlabels  fw-bold" for="structure">Structure désirée</label>
                                        <select name="structure" id="structure"  class="form-control">
                                            <option value="" selected disabled>Quelles structure désirez vous</option>
                                            
                                                <option  value="administration_publique">Administration Publique</option>
                                                <option  value="administration_privee"> Administration Privée</option>
                                                <option  value="formation_sanitaire"> Formation Sanitaire</option>
                                                <option  value="institution_microfinance"> Institution de Microfinance</option>
                                                <option  value="anyway"> N'importe quelle structure</option>
                                        
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                              
                                <div class="col-lg-6">
                                    <div class="form-group lg-6" id="fileInput">
                                        <label class="form-label">
                                            <i class="fas fa-file-alt"></i> Lettre de recommandation
                                        </label>
                                        <div class="file-upload btn btn-outline-primary w-100" >
                                            <i class="fas fa-cloud-upload-alt me-2"></i>Télécharger le fichier
                                            <input type="file" id="recommendation_letter" name="recommendation_letter" class="form-control-file" accept=".pdf,.doc,.docx" required>
                                        </div>
                                        <span class="file-info">Optionnel (PDF, DOC, DOCX)</span>
                                    </div>
                                    
                                </div>
                               <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">
                                            <i class="fas fa-id-card me-2"></i> CIP ou Carte Étudiante
                                        </label>
                                        <div class="file-upload-wrapper">
                                            <div class="file-upload-input" id="cipUploadArea">
                                                <i class="fas fa-cloud-upload-alt me-2"></i>
                                                <span id="cipFileName">Téléverser le fichier</span>
                                                <input type="file" id="cip" name="cip" class="d-none" 
                                                    accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" required>
                                            </div>
                                            <div class="file-requirements text-muted mt-2">
                                                Formats acceptés: PDF, JPG, PNG, DOC, DOCX (max 2MB)
                                            </div>
                                        </div>
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




                    document.getElementById('cip').addEventListener('change', function(e) {
                if (this.files.length > 0) {
                    document.getElementById('cipFileName').textContent = this.files[0].name;
                    document.getElementById('cipUploadArea').classList.add('file-selected');
                }
            });

            // Drag and drop
            const cipArea = document.getElementById('cipUploadArea');
            cipArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                cipArea.classList.add('dragover');
            });

            cipArea.addEventListener('dragleave', () => {
                cipArea.classList.remove('dragover');
            });

            cipArea.addEventListener('drop', (e) => {
                e.preventDefault();
                cipArea.classList.remove('dragover');
                
                if (e.dataTransfer.files.length) {
                    document.getElementById('cip').files = e.dataTransfer.files;
                    document.getElementById('cipFileName').textContent = e.dataTransfer.files[0].name;
                    cipArea.classList.add('file-selected');
                }
            });

            // Clic sur la zone pour déclencher l'input
            cipArea.addEventListener('click', () => {
                document.getElementById('cip').click();
            });
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