@extends('clients.master-1')
@section('extra-style')
    <link rel="stylesheet" href="{{asset('clients/assets/css/niceselect.css')}}"/>
    <link rel="stylesheet" href="{{asset(('clients/assets/css/shop.css'))}}"/>
    <link rel="stylesheet" href="{{asset(('clients/assets/css/styles_perso.css'))}}"/>
    <link rel="stylesheet" href="{{asset(('clients/assets/css/profile.css'))}}"/>
    <link rel="stylesheet" href="{{asset(('clients/assets/css/btn-groupe.css'))}}"/>
    <link rel="stylesheet" href="{{asset(('stdev/css/badge-status.css'))}}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .badge-pending {
    background-color: #ffc107;
    color: #212529;
}

.badge-pending_signature {
    background-color: #17a2b8;
    color: white;
}

.badge-under_review {
    background-color: #007bff;
    color: white;
}

.badge-approved {
    background-color: #28a745;
    color: white;
}

.badge-rejected {
    background-color: #dc3545;
    color: white;
}

.contract-upload-form {
    display: flex;
    gap: 10px;
}

.contract-upload-form input[type="file"] {
    flex-grow: 1;
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
                    <ul>
                        <li class="fw-bold">Mes commandes</li>
                    </ul>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>

    <div class="container-fluid" style="background-color: #f6f6f6">

        <div class="row">
            <div class="col-lg-3 col-sm-12 col-xs-12 mt-5 pt-2">
                <div class="container"><h2 class="fw-bold">Salut👋</h2>
                    <h2 class="fw-bold mb-2"> {{ session('clientInfo') ->fist_name}}</h2></div>
                <span class="button-groups-1 d-flex justify-content-center d-block d-lg-none ">
                  <button type="button" class="active"><a href="{{route('dash.client')}}" style="color: #FFF">Demandes de Stage</a></button>
                  {{-- <button type="button"> <a href="{{route('dash.client')}}"
                                            style="color: #1a2d62">Mes achats</a></button> --}}
                  <button type="button"> <a href="{{route('client.profile')}}"
                                            style="color: #1a2d62">Profile</a></button>
                </span>
                <div class="sidebar-post d-none d-lg-block">
                    <div class="sidebar_title"><h4>Tableau de Bord</h4></div>
                    <div class="sidebar-banner">
                        <a class="profil-link-active" href="{{route('internships.index')}}">Mes Demandes</a>
                        <hr>
                        <a class="profil-link-active" href="{{route('dash.client')}}">Mes commandes</a>

                        {{-- <hr>
                        <a class="profil-link" href="#">Mes achats</a> --}}
                        <hr>
                        <a class="profil-link" href="{{route('client.profile')}}">Profile</a>
                    </div><!-- END SOCIAL MEDIA POST -->
                </div>
                <!-- END SIDEBAR POST -->
            </div><!--- END COL -->
         <div class="col-lg-9 col-sm-12 col-xs-12">
    <div class="shopping-cart section">
        <div class="container">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    
                @endif
            <div class="col-12 table-responsive">
                @if($requests->count() > 0)
                    <table class="table shopping-summery" id="dataTable">
                        <thead>
                            <tr class="main-hading">
                                <th>ÉTUDIANT</th>
                                <th>DÉTAILS</th>
                                <th class="text-center">STATUT</th>
                                <th class="text-center">CONTRAT</th>
                                <th class="text-center">EVOLUTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $request)
                                @php
                                    $badge = 'badge-'.strtolower(str_replace([' ', 'é'], ['-', 'e'], $request->status));
                                @endphp
                                <tr>
                                    <td class="image" data-title="Étudiant">
                                        <img src="{{ asset('assets/images/student-icon.png') }}" alt="#">
                                        <p>{{ $request->user->name }}</p>
                                    </td>
                                    <td class="product-des" data-title="Détails">
                                        <p class="product-name"><strong>{{ $request->university }}</strong></p>
                                        <p class="product-des">{{ $request->field }} - {{ $request->level }}</p>
                                        <p>{{ $request->company }}, {{ $request->commune }}</p>
                                        @if($request->binome)
                                            <p><small>Binôme: {{ $request->binome }}</small></p>
                                        @endif
                                    </td>
                                    <td class="price" data-title="Statut">
                                        @if ($request->status == 'pending')
                                            <span class="badge badge-pending_signature">En attente de signature</span>
                                       
                                        @elseif ($request->status == 'under_review')
                                            <span class="badge badge-under_review">En cours de traitement</span>
                                        @elseif ($request->status == 'approved')
                                            <span class="badge badge-approved">Accepté</span>
                                            
                                        @endif
                                    </td>
                                    <td class="contract" data-title="Contrat">
                                        @if($request->contract_path)
                                            <a href="{{ route('internship.download', $request->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="ti-download"></i> Télécharger
                                            </a>
                                        @else
                                            <span class="text-muted">Non généré</span>
                                        @endif
                                    </td>
                                    <td class="action">
                                        <span>
                                            @if($request->status == 'pending')
                                                <form action="{{ route('internship.upload-signed') }}" method="POST" enctype="multipart/form-data" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="request_id" value="{{ $request->id }}">
                                                    <div class="input-group">
                                                        <label for="signed_contract">Contrat signé</label>
                                                        <input type="file" name="signed_contract" class="form-control form-control-sm" accept="application/pdf" required>
                                                        <button type="submit" id="submitBtn" class="btn btn-sm btn-success">
                                                            <i class="ti-upload"></i>
                                                        </button>
                                                    </div>
                                                </form>

                                            @elseif ($request->status == 'under_review')
                                                <span class="badge badge-under_review">Contrat final envoyé</span>

                                            @elseif ($request->status == 'approved')
                                               
                                                <a href="{{ route('internship.uploaded', $request->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="ti-download"></i>Autorisation
                                                </a>
                                           
                                            @endif
                                          
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $requests->links('pagination::bootstrap-5') }}
                    </div>
                @else
                    <div class="alert alert-info">Aucune demande de stage trouvée</div>
                @endif
            </div>
        </div>
    </div>
</div>

        </div><!-- END ROW-->
    </div>

<!-- Ajouter dans votre HTML -->
<div class="modal fade" id="loadingModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Chargement...</span>
                </div>
                <p class="mt-3">Envoi du contrat en cours...</p>
            </div>
        </div>
    </div>
</div>


    <!-- Modal de succès -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Succès!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Votre contrat signé a été envoyé avec succès.</p>
                <p class="mb-0">Notre équipe va maintenant vérifier votre document et vous informera par email de la suite du processus.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <a href="" class="btn btn-primary">Retour au tableau de bord</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'erreur -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Erreur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="errorMessage">
                <!-- Le message d'erreur sera injecté ici -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
    
    <script src="{{asset('clients/assets/js/nicesellect.js?'.Str::uuid())}}"></script>
    <script type="module" src="{{asset('clients/js-data/dash.js?'.Str::uuid())}}">
    <script type="text/javascript">
        $('select').niceSelect();
    </script>

    <script>
          document.addEventListener('DOMContentLoaded', function() {
            const submitBtn= document.getElementById('submitBtn');
            submitBtn.addEventlistener('click', function(event) {
                event.preventDefault(); // Prevent the default form submission
                const loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));
                    loadingModal.show();
                    $.ajax({
                        headers: {
                            'Accept': 'application/json;charset=utf-8',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        url: "{{ route('internship.upload-signed') }}",
                        type: "POST",
                        data: new FormData(this.form),
                        processData: false,
                        contentType: false,
                        dataType: 'JSON',

                        success: function(response) {
                            if(response.success===true) {
                                // Afficher le modal de succès
                                const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                                successModal.show();
                                
                              
                            } else {
                                // Afficher le modal d'erreur
                                document.getElementById('errorMessage').innerHTML = 
                                    `<p>Erreur lors de l'envoi du contrat : ${response.message}</p>
                                    <p class="mt-2">Veuillez réessayer ou contacter le support si le problème persiste.</p>`;
                                
                                const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                                errorModal.show();
                            }
                        },
                        error: function(xhr) {
                            let errorMessage = "Une erreur inconnue s'est produite";
                            
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            } else if (xhr.statusText) {
                                errorMessage = xhr.statusText;
                            }
                            
                            document.getElementById('errorMessage').innerHTML = 
                                `<p>Erreur technique : ${errorMessage}</p>
                                <p class="mt-2">Code d'erreur: ${xhr.status}</p>`;
                            
                            const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                            errorModal.show();
                            loadingModal.hide(); // Hide the loading modal in case of error
                        }
                    });
            });
        });
        
    </script>

@endsection
