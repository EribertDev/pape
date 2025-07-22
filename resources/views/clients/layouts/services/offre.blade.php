@extends('clients.master-1')

@section('extra-style')

    <link rel="stylesheet" href="{{asset('client/js-simple-loader-main/loader.css')}}" />
    <script  src="{{asset('client/js-simple-loader-main/loader.js')}}"  ></script>
font-awesome
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

    <style>
    .hover-scale {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-scale:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1);
    }
    .premium-card {
        border: 2px solid #ffd700 !important;
    }
    .bg-gold-gradient {
        background: linear-gradient(135deg, #ffd700, #ff9800);
    }
    .btn-gold-gradient {
        background: linear-gradient(135deg, #ffd700, #ff9800);
        border: none;
        font-weight: 600;
    }
    .btn-gold-gradient:hover {
        background: linear-gradient(135deg, #ffc107, #ff8c00);
        transform: scale(1.03);
    }
    .step-card {
        transition: all 0.3s ease;
        height: 100%;
    }
    .step-card:hover {
        background: rgba(13, 110, 253, 0.05);
    }
    .step-number {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
    /* Style pour le sélecteur */
#serviceType {
    border: 2px solid #dee2e6;
    padding: 12px 15px;
    transition: all 0.3s;
}

#serviceType:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

/* Style des options */
#serviceType option {
    padding: 10px;
}

/* Style pour VIP */
#serviceType option[value="vip"] {
    font-weight: bold;
    background-color: #fff3cd;
}
</style>
@endsection

@section('page-content')
  
    <div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Nos Offres de Rédaction</h1>
        <p class="lead text-muted">Choisissez la formule qui correspond le mieux à vos besoins</p>
    </div>

    <div class="row g-4 justify-content-center">
        <!-- Offre Standard -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-lg h-100 hover-scale">
                <div class="card-header bg-primary text-white py-4">
                    <h2 class="h3 mb-0">Formule Standard</h2>
                    <div class="price mt-2">
                        <span class="h2">Prix normal</span>
                        <span class="text-white-50">/document</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <ul class="list-group list-group-flush mb-4">
                         <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Rédaction  par un expert
                        </li>
                       <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Mise en forme professionnelle
                        </li>
                      
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-times-circle me-2"></i>
                            Délai moyen: 4 jours
                        </li>
                      
                    </ul>
                    <a href="{{ route('service.redaction', ['type' => 'standard']) }}?type=standard" 
                       class="btn btn-outline-primary w-100 py-3">
                        Choisir l'offre Standard
                    </a>
                </div>
            </div>
        </div>

        <!-- Offre VIP -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-lg h-100 hover-scale premium-card">
                <div class="card-header bg-gold-gradient py-4 position-relative">
                    <span class="badge bg-white text-dark position-absolute top-0 start-50 translate-middle px-3 py-2 rounded-pill shadow-sm">
                        <i class="fas fa-crown me-1"></i> POPULAIRE
                    </span>
                    <h2 class="h3 mb-0">Formule VIP</h2>
                    <div class="price mt-2">
                        <span class="h2">+50%</span>
                        <span class="text-white-50">/document</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Rédaction  par un expert
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Mise en forme professionnelle
                        </li>
                      
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            Délai express: 48h max
                        </li>
                       
                    </ul>
                    <a href="{{ route('service.redaction', ['type' => 'vip']) }}?type=vip" 
                       class="btn btn-gold-gradient w-100 py-3 text-white">
                        Choisir l'offre VIP
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-10 mx-auto">
            <div class="bg-light p-4 rounded-3">
                <h3 class="mb-3"><i class="fas fa-question-circle text-primary me-2"></i>Comment ça marche ?</h3>
                <div class="row text-center">
                    <div class="col-md-3 mb-3">
                        <div class="step-card p-3 rounded">
                            <div class="step-number bg-primary text-white rounded-circle mx-auto">1</div>
                            <h5 class="mt-3">Choisissez votre offre</h5>
                            <p>Standard ou VIP selon vos besoins</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="step-card p-3 rounded">
                            <div class="step-number bg-primary text-white rounded-circle mx-auto">2</div>
                            <h5 class="mt-3">Remplissez le formulaire</h5>
                            <p>Décrivez votre projet en détail</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="step-card p-3 rounded">
                            <div class="step-number bg-primary text-white rounded-circle mx-auto">3</div>
                            <h5 class="mt-3">Paiement sécurisé</h5>
                            <p>Payez en ligne simplement</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="step-card p-3 rounded">
                            <div class="step-number bg-primary text-white rounded-circle mx-auto">4</div>
                            <h5 class="mt-3">Recevez votre document</h5>
                            <p>Dans les délais convenus</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('extra-scripts')

   
@endsection
