@extends('clients.master-1')

@section('extra-style')
<link rel="stylesheet" href="{{asset('clients/assets/css/reprography.css')}}">

@endsection

@section('page-content')

  <div class="container py-5 mt-5 ">
    <div class="row justify-content-center">
      <div class="col-lg-10">
            <div class="card" style="margin-top: 150px;">
                <div class="card-header ">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h2 class="mb-1 text-white">Commander un service de reprographie</h2>
                            <p class="mb-0 text-white opacity-75">Commander et recevoir en toute confidentialité les impressions, photocopies, saisies, scannages et reliure de vos documents.</p>
                        </div>
                        <div class="feature-icon">
                            <i class="fas fa-copy"></i>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Step indicator -->
                    <div class="step-indicator">
                        <div class="step active">
                            <span class="step-label">Commande</span>
                        </div>
                        <div class="step">
                            <span class="step-label">Livraison</span>
                        </div>
                        <div class="step">
                            <span class="step-label">Paiement</span>
                        </div>
                    </div>
                    
                    <form id="reprographyForm" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Section 1: Informations de base -->
                        <div class="form-section">
                            <h4 class="border-bottom pb-2">
                                <i class="fas fa-info-circle me-2"></i>Informations de la commande
                            </h4>
                            <div class="row">
                                   <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-tasks"></i>Type de service
                                    </label>
                                    <select name="service_types[]" class="form-select" required >
                                        <option value="impression">Impression</option>
                                        <option value="photocopie">Photocopie</option>
                                        <option value="saisie_texte">Saisie de texte</option>
                                        <option value="tirage_photo">Tirage photo</option>
                                        <option value="carte_visite">Tirage carte de visite</option>
                                        <option value="affiche">Tirage affiche</option>
                                        <option value="flyers">Tirage flyers</option>
                                    </select>
                                    <div class="form-text">Maintenez Ctrl (Windows) ou Cmd (Mac) pour sélectionner plusieurs options</div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-user"></i>Contact du client
                                    </label>
                                    <input type="text" name="contact" class="form-control" placeholder="Votre numéro de téléphone" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-file-upload"></i>Fichier
                                    </label>
                                    
                                    <div class="file-upload-container" id="fileUploadContainer">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        <h5>Glissez-déposez votre fichier ici</h5>
                                        <p class="text-muted">ou cliquez pour parcourir</p>
                                        <input type="file" name="file" class="d-none" id="fileInput"  required>
                                        <div class="file-info" id="fileInfo">Formats acceptés: PDF, DOC, DOCX, JPG, PNG</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                             
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-palette"></i>Couleur
                                    </label>
                                    <select name="color" class="form-select">
                                        <option value="noir_blanc">Noir et blanc</option>
                                        <option value="couleur">Couleur</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-file-alt"></i>Option
                                    </label>
                                    <select name="option" class="form-select" required>
                                        <option value="Recto seul">Recto seul</option>
                                        <option value="Recto verso">Recto verso</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-ruler"></i>Format
                                    </label>
                                    <select name="format" class="form-select" required>
                                        <option value="A4">A4</option>
                                        <option value="A3">A3</option>
                                        <option value="A2">A2</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                  
                                    <label class="form-label">
                                        <i class="fas fa-book"></i>Reliure
                                    </label>
                                    
                                    <div class="d-flex align-items-center">
                                        <div class="form-check form-switch me-3">
                                            <input class="form-check-input" type="checkbox" name="binding" id="bindingCheck" role="switch" value="1" hidden>
                                            <input type="hidden" name="binding" value="0">
                                        </div>
                                       <input class="form-check-input" type="checkbox" name="binding" id="bindingCheck" role="switch" value="1">
                                        <label class="form-check-label" for="bindingCheck">Activer la reliure</label> 
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-layer-group"></i>Plastification
                                    </label>
                                    <div class="d-flex align-items-center">
                                        <div class="form-check form-switch me-3">
                                            <input class="form-check-input" type="checkbox" name="lamination" id="laminationCheck" role="switch" value="1">
                                            <input type="hidden" name="lamination" value="0">
                                        </div>
                                        <label class="form-check-label" for="laminationCheck">Activer la plastification</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-3" id="bindingTypeSection" >
                                <div class="col-md-12">
                                    <label class="form-label">
                                        <i class="fas fa-bookmark"></i>Mode de reliure
                                    </label>
                                    <select name="binding_type" class="form-select">
                                        <option value="Anneaux">Anneaux</option>
                                        <option value="Sérodo">Sérodo</option>
                                        <option value="thermique en livre">Thermique en livre</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-file"></i>Nombre de pages
                                    </label>
                                    <div class="input-group">
                                        <input type="number" name="page_count" class="form-control" min="1" placeholder="Ex: 10" required id="pageCount">
                                        <button type="button" class="btn btn-outline-secondary" id="autoDetectBtn">
                                            <i class="fas fa-magic me-1"></i> Détecter
                                        </button>
                                    </div>
                                    <div class="form-text" id="pageCountInfo">La détection fonctionne pour les fichiers PDF</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-copy"></i>Nombre d'exemplaires
                                    </label>
                                    <input type="number" name="copy_count" class="form-control" min="1" placeholder="Ex: 2" required>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Section 2: Livraison -->
                        <div class="form-section">
                            <h4 class="border-bottom pb-2">
                                <i class="fas fa-truck me-2"></i>Mode de livraison
                            </h4>
                            
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-shipping-fast"></i>Mode de livraison
                                    </label>
                                    <select name="delivery_mode" class="form-select" id="deliveryMode" required>
                                        <option value="Domicile">Domicile</option>
                                        <option value="Point relais">Point relais</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-percent"></i>Tarif appliqué
                                    </label>
                                    <div class="d-flex align-items-center">
                                        <div class="form-check form-switch me-3">
                                            @if($hasPreviousOrder)
                                                <input class="form-check-input" type="checkbox" name="student_tariff" id="studentTariff" role="switch" checked value="1" disabled>
                                                <input type="hidden" name="student_tariff" value="1">
                                            @else
                                                <input class="form-check-input" type="checkbox" name="student_tariff" id="studentTariff" role="switch" checked value="1" disabled   >
                                                <input type="hidden" name="student_tariff" value="0">
                                            @endif
                                        </div>
                                        <label class="form-check-label" for="studentTariff">Tarif étudiant</label>
                                    </div>
                                    @if($hasPreviousOrder)
                                    <div class="form-text text-success">
                                        <i class="fas fa-info-circle me-1"></i> Tarif étudiant activé automatiquement pour les clients fidèles
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div id="homeDeliverySection">
                                <h5 class="mb-3 d-flex align-items-center">
                                    <i class="fas fa-home me-2"></i>Domicile
                                </h5>
                                <div class="row mb-3">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-city"></i>Commune de résidence
                                        </label>
                                        <select name="commune" class="form-select" id="communeSelect" required>
                                            <option value="">Sélectionnez votre commune</option>
                                            <option value="Cotonou">Cotonou</option>
                                            <option value="Calavi">Calavi</option>
                                            <option value="Porto-Novo">Porto-Novo</option>
                                            <option value="Godomey">Godomey</option>
                                            <option value="Sèmè-Podji">Sèmè-Podji</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-map-marker-alt"></i>Quartier de résidence
                                        </label>
                                        <input type="text" name="neighborhood" class="form-control" placeholder="Ex:  Quartier Fifadji">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-location-dot"></i>Indication du domicile
                                        </label>
                                        <input type="text" name="address_details" class="form-control" placeholder="Ex:  Rue de l'Amazone">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label">
                                            <i class="fas fa-map-location-dot"></i>Localisation GPS
                                        </label>
                                        <div class="location-container">
                                            <input type="text" name="gps_location" class="form-control" id="gpsLocation" placeholder="Coordonnées GPS (optionnel)">
                                            <button type="button" class="get-location-btn" id="getLocationBtn">
                                                <i class="fas fa-location-crosshairs me-1"></i> Ma position
                                            </button>
                                        </div>
                                        <div class="map-preview" id="mapPreview">
                                            <i class="fas fa-map-marked-alt text-muted" style="font-size: 3rem;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="relayPointSection" style="display: none;">
                                <h5 class="mb-3 d-flex align-items-center">
                                    <i class="fas fa-store me-2"></i>Point de relais
                                </h5>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label">
                                            <i class="fas fa-map-pin"></i>Sélectionnez un point relais
                                        </label>
                                        <select name="relay_point" class="form-select">
                                            <option value="">Choisissez un point relais</option>
                                            <option value="Point Relais Centre Ville">Centre Ville</option>
                                            <option value="Point Relais Université">Université</option>
                                            <option value="Point Relais Zone Industrielle">Zone Industrielle</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Section 3: Résumé des coûts -->
                        <div class="form-section">
                            <h4 class="border-bottom pb-2">
                                <i class="fas fa-calculator me-2"></i>Récapitulatif des coûts
                            </h4>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="card cost-card h-100">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Coût de la commande</h5>
                                            <p class="card-text fs-4 text-primary fw-bold" id="orderCost">0 FCFA</p>
                                            <div class="text-muted">Basé sur vos options</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card cost-card h-100">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Coût de livraison</h5>
                                            <p class="card-text fs-4 text-primary fw-bold" id="deliveryCost">0 FCFA</p>
                                            <div class="text-muted">Selon votre localisation</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card total-cost-card text-white h-100">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Montant total</h5>
                                            <p class="card-text fs-3 fw-bold" id="totalCost">0 FCFA</p>
                                            <div class="opacity-75">TVA incluse</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg py-3">
                                <i class="fas fa-paper-plane me-2"></i> Soumettre la commande
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('extra-scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>

<script src="{{asset('clients/js-data/reprography.js')}}"></script>
<script src="{{asset('clients/assets/js/nicesellect.js?')}}"></script>
@endsection