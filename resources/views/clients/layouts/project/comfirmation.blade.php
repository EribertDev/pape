@extends('clients.master-1')

@section('extra-style')
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{asset('client/js-simple-loader-main/loader.css')}}" />
    <script  src="{{asset('client/js-simple-loader-main/loader.js')}}"  ></script>
  

    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
<style>
    .card {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .alert {
        border-radius: 10px;
    }
    
    .btn-lg {
        border-radius: 12px;
        font-weight: 600;
        padding: 12px 24px;
        transition: all 0.3s ease;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        border: none;
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #0b5ed7, #0a58ca);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }
    
    .btn-outline-secondary {
        border: 2px solid #6c757d;
    }
    
    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
    }
</style>
@endsection

@section('page-content')
        <div class="container py-5" style="margin-top: 150px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-success text-white py-4">
                    <h2 class="mb-0 text-center">Confirmation de Demande</h2>
                </div>
                <div class="card-body p-5 text-center">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                    </div>
                    <h3 class="mb-3">Votre demande a été enregistrée avec succès !</h3>
                    <p class="lead">Nous avons reçu votre demande d'assistance pour la rédaction de votre projet/business plan.</p>
                    
                    <div class="alert alert-info text-start mt-4">
                        <h5 class="mb-3"><i class="bi bi-info-circle"></i> Détails de votre demande</h5>
                        <ul class="mb-0">
                            <li><strong>Titre du projet:</strong> {{ $projectRequest->title }}</li>
                            <li><strong>Référence:</strong> #{{ $projectRequest->id }}</li>
                            <li><strong>Date de soumission:</strong> {{ $projectRequest->created_at->format('d/m/Y H:i') }}</li>
                            <li><strong>Montant à payer:</strong> 100 000 F CFA</li>
                        </ul>
                    </div>
                    
                    <p class="mt-4">Notre équipe va examiner votre demande et vous contactera dans les plus brefs délais.</p>
                    
                    <div class="d-flex justify-content-center gap-3 mt-5">
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg">Retour à l'accueil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')

   
@endsection
