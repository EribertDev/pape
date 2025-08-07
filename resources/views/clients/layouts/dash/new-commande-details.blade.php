@extends('clients.master-1')
@section('extra-style')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('clients/assets/css/niceselect.css')}}"/>
    <link rel="stylesheet" href="{{asset(('clients/assets/css/shop.css'))}}"/>
    <link rel="stylesheet" href="{{asset(('clients/assets/css/styles_perso.css'))}}"/>
    <link rel="stylesheet" href="{{asset(('clients/assets/css/profile.css'))}}"/>
    <link rel="stylesheet" href="{{asset(('stdev/css/badge-status.css'))}}" />
    <link rel="stylesheet" href="{{asset(('clients/assets/css/dash.css'))}}"/>
     <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1a2d62',
                        secondary: '#4c6fff',
                        accent: '#00c9a7',
                        light: '#f6f8ff',
                        dark: '#0f1a3f'
                    }
                }
            }
        }
    </script>

    <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>
   
@endsection

@section('page-content')
   <body class="bg-gray-50">
    <!-- Navigation Mobile -->
    <div class="mobile-nav fixed bottom-0 left-0 right-0 bg-white shadow-lg z-50 md:hidden">
        <div class="flex justify-around py-3">
            <a href="{{route('dash.client')}}" class="text-primary flex flex-col items-center">
                <i class="fas fa-home text-lg mb-1"></i>
                <span class="text-xs">Accueil</span>
            </a>
            <a href="{{route('dash.client')}}" class="text-gray-500 flex flex-col items-center">
                <i class="fas fa-file-alt text-lg mb-1"></i>
                <span class="text-xs">Commandes</span>
            </a>
            <a href="{{route('internships.dash')}}" class="text-gray-500 flex flex-col items-center">
                <i class="fas fa-graduation-cap text-lg mb-1"></i>
                <span class="text-xs">Stages</span>
            </a>
            <a href="{{route('projects.dash')}}" class="text-gray-500 flex flex-col items-center">
                <i class="fas fa-project-diagram text-lg mb-1"></i>
                <span class="text-xs">Projets</span>
            </a>
            <a href="{{route('client.profile')}}" class="text-gray-500 flex flex-col items-center">
                <i class="fas fa-user text-lg mb-1"></i>
                <span class="text-xs">Profil</span>
            </a>
        </div>
    </div>

    <div class="flex min-h-screen">
        <!-- Sidebar Desktop -->
        <div class="desktop-sidebar w-64 bg-white shadow-md fixed h-full hidden md:block">
            <div class="p-6 border-b border-gray-100">
                <h1 class="text-2xl font-bold text-primary">Mon Espace</h1>
            </div>
            
            <div class="p-4 flex items-center mt-6">
                <div class="relative">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-r from-primary to-secondary flex items-center justify-center">
                        <span class="text-white text-xl font-bold">{{ substr(session('clientInfo')->fist_name, 0, 1) }}</span>
                    </div>
                    <div class="absolute bottom-0 right-0 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></div>
                </div>
                <div class="ml-3">
                    <h3 class="font-semibold text-gray-800">{{ session('clientInfo')->fist_name }}</h3>
                </div>
            </div>
            
            <div class="mt-8 px-2">
                <a href="{{route('dash.client')}}" class="sidebar-link active flex items-center px-4 py-3 mb-2">
                    <i class="fas fa-home mr-3 text-primary"></i>
                    <span>Tableau de bord</span>
                </a>
                <a href="{{route('dash.client')}}" class="sidebar-link flex items-center px-4 py-3 mb-2">
                    <i class="fas fa-file-alt mr-3 text-gray-500"></i>
                    <span>Mes commandes</span>
                    <span class="ml-auto bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">3</span>
                </a>
                <a href="{{route('internships.dash')}}" class="sidebar-link flex items-center px-4 py-3 mb-2">
                    <i class="fas fa-graduation-cap mr-3 text-gray-500"></i>
                    <span>Mes stages</span>
                    <span class="ml-auto bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">2</span>
                </a>
                <a href="{{route('projects.dash')}}" class="sidebar-link flex items-center px-4 py-3 mb-2">
                    <i class="fas fa-project-diagram mr-3 text-gray-500"></i>
                    <span>Mes projets</span>
                    <span class="ml-auto bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">3</span>
                </a>
                <a href="{{route('message.client')}}" class="sidebar-link flex items-center px-4 py-3 mb-2">
                    <i class="fas fa-comments mr-3 text-gray-500"></i>
                    <span>Messages</span>
                    <span class="ml-auto bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">5</span>
                </a>
                <a href="{{route('client.profile')}}" class="sidebar-link flex items-center px-4 py-3 mb-2">
                    <i class="fas fa-user mr-3 text-gray-500"></i>
                    <span>Mon profil</span>
                </a>
                <a href="#" class="sidebar-link flex items-center px-4 py-3 mt-10">
                    <i class="fas fa-sign-out-alt mr-3 text-gray-500"></i>
                    <span>Déconnexion</span>
                </a>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="flex-1 md:ml-64">
            <!-- Header -->
            <header class="bg-white shadow-sm" style="margin-top: 60px;">
                <div class="flex justify-between items-center p-4">
                    <div class="flex items-center">
                        <button class="md:hidden text-gray-600 mr-4">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="text-xl font-bold text-gray-800">Détail de la commande</h1>
                    </div>
                    <div class="flex items-center">
                        <a href="{{route('dash.client')}}" class="btn-secondary mr-3">
                            <i class="fas fa-arrow-left mr-2"></i> Retour
                        </a>
                        <div class="relative mr-4">
                            <button class="text-gray-500 relative">
                                <i class="fas fa-bell text-xl"></i>
                                <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                            </button>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-700 font-bold">{{ substr(session('clientInfo')->fist_name, 0, 1) }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <main class="p-4 md:p-6">
                <!-- En-tête de la commande -->
                <div class="dashboard-card bg-white mb-6">
                    <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">{{ $commande->service?->name }}</h2>
                            <div class="mt-2 flex items-center">
                                @php
                                 
                                               
                                            $badge ='badge-'.$commande->status_name;
                                            $badge = strtolower($badge);
                                            $badge = str_replace(array(' ', 'é'), array('-', 'e'), $badge);
                                       
                                               
                                          
                                @endphp
                                <span class="badge {{ $badge }} mr-3">{{ $commande->status->name }}</span>
                                <span class="text-gray-500">Réf: #CMD-{{ substr($commande->uuid, 0, 8) }}</span>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <span class="text-xl font-bold text-primary">{{ $commande['amount'] }} XOF</span>
                        </div>
                    </div>
                    
                    <!-- Informations de la commande -->
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Discipline</h3>
                            <p class="font-medium text-gray-800">{{ $commande->discipline->name }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Délai</h3>
                            <p class="font-medium text-gray-800">{{ $commande['deadline'] }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Date de création</h3>
                            <p class="font-medium text-gray-800">{{ $commande->created_at->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Sujet</h3>
                            <p class="font-medium text-gray-800">{{ $commande['subject'] }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Section description -->
                    <div class="dashboard-card bg-white lg:col-span-2">
                        <div class="p-5 border-b border-gray-100">
                            <h3 class="font-semibold text-lg text-gray-800">Description</h3>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-700">{{ $commande['description'] }}</p>
                        </div>
                    </div>
                    
                    <!-- Section paiement et actions -->
                    <div class="dashboard-card bg-white">
                        <div class="p-5 border-b border-gray-100">
                            <h3 class="font-semibold text-lg text-gray-800">Paiement & Actions</h3>
                        </div>
                        <div class="p-6">
                            @php
                                $service = strtolower($commande->service?->name);
                                $status = strtolower($commande->status->name);
                                $file = (new \App\Models\FilePatchOfCommande())->getFinalByIdCommande($commande['id']);
                                $fileDescription = strtolower($file->description ?? '');
                                $payments = $commande->payments ?? [];
                                $totalAmount = $commande->amount;
                                $amountPaid = collect($commande->payments)->where('status.id', '20')->sum('amount');
                                $lastPayment = $commande->payments->last();
                                $lastPaidPayment = $commande->payments->where('status.id', '20')->last();
                                $amountRemaining = $totalAmount - $amountPaid;
                                $allPaymentsPaid = collect($commande->payments)->every(function ($payment) {
                                    return strtolower($payment->status->name) === "payer";
                                });
                            @endphp
                            
                            @if ($status !== "en attente")
                                <!-- Statut du paiement -->
                                <div class="mb-6">
                                    <div class="flex justify-between mb-2">
                                        <span class="text-gray-600">Total</span>
                                        <span class="font-medium">{{ $totalAmount }} XOF</span>
                                    </div>
                                    <div class="flex justify-between mb-2">
                                        <span class="text-gray-600">Payé</span>
                                        <span class="font-medium text-green-600">{{ $amountPaid }} XOF</span>
                                    </div>
                                    <div class="flex justify-between mb-4">
                                        <span class="text-gray-600">Reste à payer</span>
                                        <span class="font-medium text-primary">{{ $amountRemaining }} XOF</span>
                                    </div>
                                    
                                    <div class="progress-bar bg-gray-200 mb-1">
                                        @php
                                            $progress = $totalAmount > 0 ? ($amountPaid / $totalAmount) * 100 : 0;
                                        @endphp
                                        <div class="progress-fill bg-primary" style="width: {{ $progress }}%"></div>
                                    </div>
                                    <div class="text-right text-sm text-gray-500">{{ round($progress) }}% payé</div>
                                </div>
                                
                                <!-- Boutons d'action -->
                                <div class="space-y-3">
                                    @if ($fileDescription === "protocole" && $amountPaid >= $totalAmount / 2)
                                        <button class="btn-primary w-full download" 
                                            data-uuid="{{ $commande->uuid }}"
                                            data-pay-id="{{ $lastPaidPayment->id ?? '' }}"
                                            data-pay-status="payer">
                                            <i class="fas fa-download mr-2"></i> Télécharger
                                        </button>
                                    @elseif ($fileDescription === "complete" && $amountPaid === $totalAmount)
                                        <button class="btn-primary w-full download" 
                                            data-uuid="{{ $commande->uuid }}"
                                            data-pay-id="{{ $payments[0]->id ?? '' }}"
                                            data-pay-status="payer">
                                            <i class="fas fa-download mr-2"></i> Télécharger
                                        </button>
                                    @elseif ($fileDescription === "protocole_repertoire" && $amountPaid === $totalAmount)
                                        <button class="btn-primary w-full download" 
                                            data-uuid="{{ $commande->uuid }}"
                                            data-pay-id="{{ $lastPaidPayment->id ?? '' }}"
                                            data-pay-status="payer">
                                            <i class="fas fa-download mr-2"></i> Télécharger
                                        </button>
                                    @else
                                        <button class="btn-primary w-full payer" 
                                            id="editBtn" 
                                            data-amount-type="PS" 
                                            data-uuid="{{ $commande->uuid }}">
                                            <i class="fas fa-credit-card mr-2"></i> Payer maintenant
                                        </button>
                                        
                                        @if(!empty($commande->payments))
                                        <button class="btn-secondary w-full payer_confirme" 
                                            data-pay-id="{{ $lastPayment->id ?? '' }}"
                                            data-pay-status="{{ strtolower($lastPayment->status->name ?? '') }}">
                                            <i class="fas fa-check-circle mr-2"></i> Confirmer le paiement
                                        </button>
                                        @endif
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Fichiers joints -->
                <div class="grid grid-cols-1 gap-6 mt-6">
                    <div class="dashboard-card bg-white">
                        <div class="p-5 border-b border-gray-100">
                            <h3 class="font-semibold text-lg text-gray-800">Fichiers joints</h3>
                        </div>
                        <div class="p-6">
                            @if ($commande->filesPath && count($commande->filesPath) > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach ($commande->filesPath as $file)
                                    <div class="file-card p-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mr-3">
                                                <i class="fas fa-file text-blue-600"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="font-medium text-gray-800 truncate">{{ $file->reference }}</p>
                                                <p class="text-xs text-gray-500">{{ $file->created_at->format('d/m/Y H:i') }}</p>
                                            </div>
                                            <a href="{{ asset('storage/' . $file->path) }}" download="{{ basename($file->path) }}" class="text-primary hover:text-secondary ml-2">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                    @if($commande->commune_stage)
                                        @foreach (json_decode($commande->commune_stage, true) as $index => $file)
                                        <div class="file-card p-4">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center mr-3">
                                                    <i class="fas fa-file-alt text-purple-600"></i>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="font-medium text-gray-800 truncate">{{ $file['n'] }}</p>
                                                    <p class="text-xs text-gray-500">Fichier stage</p>
                                                </div>
                                                <a href="{{ asset('storage/' . $file['p']) }}" download="{{ $file['n'] }}" class="text-primary hover:text-secondary ml-2">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                            @else
                                <p class="text-gray-500 text-center py-4">Aucun fichier joint disponible.</p>
                            @endif
                            
                            <!-- Formulaire d'ajout de fichiers -->
                            <div class="mt-8">
                                <h4 class="font-medium text-gray-800 mb-3">Ajouter des fichiers</h4>
                                <form id="uploadFileForm" enctype="multipart/form-data" class="upload-section p-4 rounded-lg">
                                    @csrf
                                    <input type="hidden" name="commande_id" value="{{ $commande->id }}">
                                    
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Sélectionner des fichiers
                                        </label>
                                        <div class="flex items-center justify-center w-full">
                                            <label for="newFiles" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                                    <p class="text-sm text-gray-500">
                                                        <span class="font-semibold">Cliquez pour télécharger</span> ou glissez-déposez
                                                    </p>
                                                    <p class="text-xs text-gray-500">PDF, DOCX, XLSX, JPG, PNG (max 10MB)</p>
                                                </div>
                                                <input id="newFiles" name="files[]" type="file" class="hidden" multiple>
                                            </label>
                                        </div> 
                                    </div>
                                    
                                    <button type="submit" class="btn-primary w-full">
                                        <i class="fas fa-upload mr-2"></i> Envoyer les fichiers
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Fichier de l'équipe PAPE -->
                    @if ($commande->attachments)
                    <div class="dashboard-card bg-white">
                        <div class="p-5 border-b border-gray-100">
                            <h3 class="font-semibold text-lg text-gray-800">Fichier de l'équipe PAPE</h3>
                        </div>
                        <div class="p-6">
                            <div class="file-card p-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center mr-3">
                                        <i class="fas fa-file-pdf text-green-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-800">Document final</p>
                                        <p class="text-xs text-gray-500">Fourni par notre équipe</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{route('download.file', $commande->id)}}" class="btn-primary px-3 py-1 text-sm">
                                            <i class="fas fa-download mr-1"></i> Télécharger
                                        </a>
                                        <a href="{{ route('view.file', $commande->id) }}" target="_blank" class="btn-secondary px-3 py-1 text-sm">
                                            <i class="fas fa-eye mr-1"></i> Voir
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </main>
        </div>
    </div>

  
@endsection

@section('extra-scripts')
<div class="modal fade" id="payModal" tabindex="-1" aria-labelledby="payModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div id="embed" style="width: 500px; height: 420px;position:absolute;" ></div>
            <div class="modal-body">
                <div class="text-center">
                    <h4 class="modal-title text-center fw-bold" id="exampleModalLabel">Succès</h4>
                    <div>
                        <img class="mt-3" src="{{asset('clients/assets/images/icon/valide.png')}}" alt="" style="width: 70px;height: 70px">
                    </div>
                    <div>
                        <h5 class="mt-3" id="s_title_msg">Paiement éffectue avec succès</h5>
                        <p class="text-muted" id="s_msg" >Merci pour votre confiance</p>
                    </div>
                    <button type="button" class="btn_two mt-3 cancel__pay" data-bs-dismiss="modal">ok</button>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="payErrorModal" tabindex="-1" aria-labelledby="payErrorModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div id="embed" style="width: 500px; height: 420px;position:absolute;" ></div>
            <div class="modal-body">
                <div class="text-center">
                    <h4 class="modal-title text-center fw-bold" id="exampleModalLabel">Erreur</h4>
                    <div>
                        <img class="mt-2" src="{{asset('clients/assets/images/icon/caution.png')}}" alt="" style="width: 70px;height: 70px">
                    </div>
                    <div>
                        <h5 class="mt-2" id="e_title_msg">Paiement échoué ou annulé</h5>
                        <p class="text-muted" id="e_msg">Si votre compte a été débité, veuillez cliquer sur le bouton "J'ai Payer" pour vérifier votre paiement ou contactez-nous.</p>
                    </div>
                    {{-- <div class="text-start">
                        <p class="text-muted ms-4">Référence commande : <span id="ref__cmd"></span></p>
                        <p class="text-muted ms-4">Id payement : <span id="id__pay"></span></p>
                    </div> --}}
                    <div class="d-flex justify-content-center mt-2 gap-3">
                        <button type="button" class="btn_two mt-3 cancel__pay" data-bs-dismiss="modal" id="cancel__pay">OK</button>
                        {{-- <button type="button" class="btn_one mt-3 border-0" >Réclamation</button> --}}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
    <script src="{{asset('clients/assets/js/nicesellect.js')}}"></script>
    <script type="text/javascript">
        $('select').niceSelect();
    </script>
    <script type="module" src="{{asset('clients/js-data/dash.js?'.Str::uuid())}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
        // Animation pour les cartes au chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.dashboard-card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 100);
                }, index * 100);
            });
            
            // Gestion du menu mobile
            const mobileMenuBtn = document.querySelector('.md-hide + header button');
            const sidebar = document.querySelector('.desktop-sidebar');
            
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('hidden');
                });
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            // Gestion de l'upload de fichiers
            $('#uploadFileForm').on('submit', function(e) {
                e.preventDefault();
                
                let formData = new FormData(this);
                
                $.ajax({
                    url: "{{ route('commandes.uploadFiles') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        // Afficher un loader
                        Swal.fire({
                            title: 'Envoi en cours',
                            html: 'Traitement de vos fichiers...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Fichiers ajoutés !',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 3000
                        });
                        
                        // Recharger la page ou mettre à jour dynamiquement
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    },
                    error: function(xhr) {
                        let errorMessage = 'Une erreur est survenue';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur',
                            text: errorMessage,
                        });
                    }
                });
            });
            
            // Gestion de la suppression de fichiers
            $('.delete-file').on('click', function() {
                let fileId = $(this).data('file-id');
                
                Swal.fire({
                    title: 'Confirmer la suppression',
                    text: "Êtes-vous sûr de vouloir supprimer ce fichier ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, supprimer',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "",
                            type: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}",
                                file_id: fileId
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Supprimé !',
                                    response.message,
                                    'success'
                                ).then(() => {
                                    window.location.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Erreur !',
                                    'La suppression a échoué',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>

@endsection
