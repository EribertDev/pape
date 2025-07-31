@extends('clients.master-1')
@section('extra-style')
    <style>
    body {
        background-color: #f8f9fa;
    }
    
    .card {
        border-radius: 15px;
        overflow: hidden;
    }
    
    .card-header {
        border-radius: 15px 15px 0 0 !important;
    }
    
    .detail-card {
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
    }
    
    .detail-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    .accordion-button {
        font-weight: 600;
        border-radius: 10px !important;
        margin-bottom: 10px;
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
    }
    
    .accordion-button:not(.collapsed) {
        background-color: #e9f7fe;
        color: #0d6efd;
        box-shadow: none;
    }
    
    .payment-section {
        border: 1px solid #e9ecef;
        border-radius: 15px;
    }
    
    .steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin: 40px 0;
    }
    
    .steps::before {
        content: '';
        position: absolute;
        top: 25px;
        left: 0;
        right: 0;
        height: 2px;
        background-color: #e9ecef;
        z-index: 1;
    }
    
    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 2;
        width: 25%;
    }
    
    .step-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: white;
        border: 2px solid #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
        font-size: 1.25rem;
        color: #6c757d;
    }
    
    .step.completed .step-icon {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: white;
    }
    
    .step-text {
        text-align: center;
        padding: 0 5px;
    }
    
    .step-text h6 {
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .step-text p {
        font-size: 0.8rem;
        color: #6c757d;
        margin-bottom: 0;
    }
    
    .btn-success {
        background: linear-gradient(135deg, #00b09b, #96c93d);
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-success:hover {
        background: linear-gradient(135deg, #00a592, #85b62e);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 176, 155, 0.3);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .steps {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .steps::before {
            display: none;
        }
        
        .step {
            flex-direction: row;
            width: 100%;
            margin-bottom: 20px;
        }
        
        .step-icon {
            margin-right: 15px;
            margin-bottom: 0;
        }
        
        .step-text {
            text-align: left;
        }
        
        .accordion-button {
            font-size: 0.95rem;
        }
    }
    
    @media (max-width: 576px) {
        .card-header h1 {
            font-size: 1.25rem;
        }
        
        .payment-section .row > div {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>
@endsection


@section('page-content')
   <section class="section-top">
        <div class="container">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s"
                     data-wow-offset="0"
                     style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInRight;">
                    <h1>Mon espace Client</h1>
                    {{-- <ul>
                         <li><a href="index.html">Mon espace Client</a></li>
                         <li> / Cart</li>
                     </ul>--}}
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>



    <div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h4 mb-0">{{ $project->title }}</h1>
                        <span class="badge bg-light text-primary">{{ $project->status }}</span>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <!-- Progress bar -->
                    <div class="progress mb-5" style="height: 12px; border-radius: 10px;">
                        <div class="progress-bar bg-success" 
                             role="progressbar" 
                             style="width: {{ $project->status === 'completed' ? 100 : ($project->status === 'in_progress' ? 60 : 20) }}%" 
                             aria-valuenow="{{ $project->status === 'completed' ? 100 : ($project->status === 'in_progress' ? 60 : 20) }}" 
                             aria-valuemin="0" 
                             aria-valuemax="100">
                        </div>
                    </div>
                    
                    <!-- Project details -->
                    <div class="project-details mb-5">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="detail-card bg-light p-3 rounded">
                                    <h6 class="text-muted mb-2">Référence</h6>
                                    <p class="fw-bold">#{{ $project->id }}</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="detail-card bg-light p-3 rounded">
                                    <h6 class="text-muted mb-2">Date de création</h6>
                                    <p class="fw-bold">{{ $project->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="detail-card bg-light p-3 rounded">
                                    <h6 class="text-muted mb-2">Budget disponible</h6>
                                    <p class="fw-bold">{{ number_format($project->budget, 0, ',', ' ') }} F CFA</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="detail-card bg-light p-3 rounded">
                                    <h6 class="text-muted mb-2">Frais de service</h6>
                                    <p class="fw-bold">100 000 F CFA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Project sections -->
                    <div class="accordion mb-5" id="projectAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingProblem">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProblem" aria-expanded="true" aria-controls="collapseProblem">
                                    <i class="fas fa-question-circle me-2"></i> Problème à résoudre
                                </button>
                            </h2>
                            <div id="collapseProblem" class="accordion-collapse collapse show" aria-labelledby="headingProblem" data-bs-parent="#projectAccordion">
                                <div class="accordion-body">
                                    <p class="mb-0">{{ $project->problem }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingObjective">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseObjective" aria-expanded="false" aria-controls="collapseObjective">
                                    <i class="fas fa-bullseye me-2"></i> Objectifs du projet
                                </button>
                            </h2>
                            <div id="collapseObjective" class="accordion-collapse collapse" aria-labelledby="headingObjective" data-bs-parent="#projectAccordion">
                                <div class="accordion-body">
                                    <h6>Objectif général :</h6>
                                    <p>{{ $project->general_objective }}</p>
                                    
                                    <h6>Objectifs spécifiques :</h6>
                                    <p>{{ $project->specific_objectives }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingBeneficiaries">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBeneficiaries" aria-expanded="false" aria-controls="collapseBeneficiaries">
                                    <i class="fas fa-users me-2"></i> Bénéficiaires & Partenaires
                                </button>
                            </h2>
                            <div id="collapseBeneficiaries" class="accordion-collapse collapse" aria-labelledby="headingBeneficiaries" data-bs-parent="#projectAccordion">
                                <div class="accordion-body">
                                    <h6>Bénéficiaires :</h6>
                                    <p>{{ $project->beneficiaries }}</p>
                                    
                                    <h6>Partenaires :</h6>
                                    <p>{{ $project->partners }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingDocument">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDocument" aria-expanded="false" aria-controls="collapseDocument">
                                    <i class="fas fa-file-alt me-2"></i> Document du projet
                                </button>
                            </h2>
                            <div id="collapseDocument" class="accordion-collapse collapse" aria-labelledby="headingDocument" data-bs-parent="#projectAccordion">
                                <div class="accordion-body">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-pdf text-danger me-3" style="font-size: 3rem;"></i>
                                        <div>
                                            <p class="mb-1">Document téléchargé</p>
                                            <a href="{{ Storage::url($project->document_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-download me-1"></i> Télécharger
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Payment section -->
                    <div class="payment-section bg-light p-4 rounded mb-4">
                        <h4 class="mb-4 text-center"><i class="fas fa-credit-card me-2"></i> Paiement du service</h4>
                        
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div class="d-flex align-items-center">
                                    <div class="bg-white p-3 rounded shadow-sm me-3">
                                        <i class="fas fa-money-bill-wave text-success" style="font-size: 2rem;"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">100 000 F CFA</h5>
                                        <p class="text-muted mb-0">Frais de service</p>
                                    </div>
                                </div>
                            </div>
                            
                           <div class="col-md-6">
                            @switch($project->status)
                                @case('pending')
                                    <div class="alert alert-info mb-0">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-clock me-3" style="font-size: 1.5rem;"></i>
                                            <div>
                                                <h5 class="mb-1">En attente de validation</h5>
                                                <p class="mb-0">Votre projet est en cours d'examen par notre équipe</p>
                                            </div>
                                        </div>
                                    </div>
                                    @break

                                @case('approved')
                                    <div class="border border-success rounded p-3 mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            <h5 class="mb-0">Projet approuvé !</h5>
                                        </div>
                                        <p class="mb-0">Votre projet a été validé. Vous pouvez maintenant procéder au paiement.</p>
                                    </div>
                                    <a href="" class="btn btn-success btn-lg w-100 py-3 fw-bold">
                                        <i class="fas fa-lock me-2"></i> Payer maintenant (100 000 F CFA)
                                    </a>
                                    <p class="text-center text-muted mt-2 mb-0">Paiement sécurisé</p>
                                    @break

                                @case('paid')
                                    <div class="alert alert-success mb-0">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-check-circle me-3" style="font-size: 1.5rem;"></i>
                                            <div>
                                                <h5 class="mb-1">Paiement effectué</h5>
                                                <p class="mb-0">Le {{ $project->created_at->format('d/m/Y à H:i') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @break

                                @case('in_progress')
                                    <div class="alert alert-primary mb-0">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-tasks me-3" style="font-size: 1.5rem;"></i>
                                            <div>
                                                <h5 class="mb-1">En cours de rédaction</h5>
                                                <p class="mb-0">Notre équipe travaille sur votre projet</p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    @break

                                @case('completed')
                                    <div class="alert alert-success mb-0">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-check-circle me-3" style="font-size: 1.5rem;"></i>
                                            <div>
                                                <h5 class="mb-1">Projet finalisé</h5>
                                                <p class="mb-0">Votre projet est prêt à être téléchargé</p>
                                                <a href="" class="btn btn-success mt-2">
                                                    <i class="fas fa-download me-1"></i> Télécharger le projet final
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @break

                                @case('rejected')
                                    <div class="alert alert-danger mb-0">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-times-circle me-3" style="font-size: 1.5rem;"></i>
                                            <div>
                                                <h5 class="mb-1">Projet non retenu</h5>
                                                <p class="mb-0">Notre équipe n'est pas en mesure de traiter votre projet</p>
                                                <p class="mb-0 mt-2"><strong>Raison :</strong> {{ $project->rejection_reason ?? "Non spécifiée" }}</p>
                                                <a href="{{ route('contact') }}" class="btn btn-outline-danger mt-2">
                                                    <i class="fas fa-comment me-1"></i> Demander des précisions
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @break

                                @default
                                    <div class="alert alert-warning mb-0">
                                        <i class="fas fa-exclamation-triangle me-2"></i> Statut inconnu
                                    </div>
                            @endswitch
                        </div>
                        </div>
                    </div>
                    
                    <!-- Next steps -->
                    <div class="next-steps mt-5">
                        <h4 class="mb-4 text-center">Prochaines étapes</h4>
                        
                        <div class="steps">
                            <div class="step {{ $project->status !== 'pending_payment' ? 'completed' : '' }}">
                                <div class="step-icon">
                                    <i class="fas fa-{{ $project->status !== 'pending_payment' ? 'check' : 'money-bill' }}"></i>
                                </div>
                                <div class="step-text">
                                    <h6>Paiement</h6>
                                    <p class="mb-0">Effectuez le paiement pour démarrer</p>
                                </div>
                            </div>
                            
                            <div class="step {{ $project->status === 'in_progress' || $project->status === 'completed' ? 'completed' : '' }}">
                                <div class="step-icon">
                                    <i class="fas fa-{{ $project->status === 'in_progress' || $project->status === 'completed' ? 'check' : 'search' }}"></i>
                                </div>
                                <div class="step-text">
                                    <h6>Analyse</h6>
                                    <p class="mb-0">Notre équipe analyse votre projet</p>
                                </div>
                            </div>
                            
                            <div class="step {{ $project->status === 'completed' ? 'completed' : '' }}">
                                <div class="step-icon">
                                    <i class="fas fa-{{ $project->status === 'completed' ? 'check' : 'edit' }}"></i>
                                </div>
                                <div class="step-text">
                                    <h6>Rédaction</h6>
                                    <p class="mb-0">Rédaction professionnelle du projet</p>
                                </div>
                            </div>
                            
                            <div class="step {{ $project->status === 'completed' ? 'completed' : '' }}">
                                <div class="step-icon">
                                    <i class="fas fa-{{ $project->status === 'completed' ? 'check' : 'box' }}"></i>
                                </div>
                                <div class="step-text">
                                    <h6>Livraison</h6>
                                    <p class="mb-0">Réception de votre projet finalisé</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
          
        </div>
    </div>
</div>
@endsection