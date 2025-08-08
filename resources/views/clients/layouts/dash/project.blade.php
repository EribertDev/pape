@extends('clients.master-1')
@section('extra-style')
    <link rel="stylesheet" href="{{asset('clients/assets/css/niceselect.css')}}"/>
    <link rel="stylesheet" href="{{asset(('clients/assets/css/shop.css'))}}"/>
    <link rel="stylesheet" href="{{asset(('clients/assets/css/styles_perso.css'))}}"/>
    <link rel="stylesheet" href="{{asset(('clients/assets/css/profile.css'))}}"/>
    <link rel="stylesheet" href="{{asset(('clients/assets/css/btn-groupe.css'))}}"/>
    <link rel="stylesheet" href="{{asset(('stdev/css/badge-status.css'))}}"/>
         <script src="https://cdn.tailwindcss.com"></script>

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
 <div class="mobile-nav fixed bottom-0 left-0 right-0 bg-white shadow-lg z-50 md:hidden">
        <div class="flex justify-around py-3">
            <a href="{{route('dash.client')}}" class="text-primary flex flex-col items-center" style="margin-right: 30px;">
                <i class="fas fa-home text-lg mb-1"></i>
                <span class="text-xs">Mon Espace</span>
            </a>
            <a href="{{route('dash.client')}}" class="text-gray-500 flex flex-col items-center" style="margin-right: 30px;">
                <i class="fas fa-file-alt text-lg mb-1"></i>
                <span class="text-xs">Commandes</span>
            </a>
            <a href="{{route('internships.dash')}}" class="text-gray-500 flex flex-col items-center" style="margin-right: 30px;">
                <i class="fas fa-graduation-cap text-lg mb-1"></i>
                <span class="text-xs">Stages</span>
            </a>
            <a href="{{route('projects.dash')}}" class="text-gray-500 flex flex-col items-center" style="margin-right: 30px;">
                <i class="fas fa-project-diagram text-lg mb-1"></i>
                <span class="text-xs">Projets</span>
            </a>
            <a href="{{route('message.client')}}" class="text-gray-500 flex flex-col items-center" style="margin-right: 30px;">
                <i class="fas fa-comments text-lg mb-1"></i>
                <span class="text-xs">Messages</span>
            </a>
            <a href="{{route('client.profile')}}" class="text-gray-500 flex flex-col items-center" style="margin-right: 30px;">
                <i class="fas fa-user text-lg mb-1"></i>
                <span class="text-xs">Profil</span>
            </a>
        </div>
    </div>
    <section class="section-top">
        <div class="container">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s"
                     data-wow-offset="0"
                     style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInRight;">
                    <h1>Mon espace Client</h1>
                    <ul>
                        <li class="fw-bold">Mes Projets</li>
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
                    <a href="{{route('dash.client')}}" class="btn-secondary mr-3">
                            <i class="fas fa-arrow-left mr-2"></i> Retour
                        </a>
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
                                <th class="text-center text-primary">CLIENT</th>
                                <th class="text-center text-primary">DÉTAILS</th>
                                <th class="text-center text-primary">STATUT</th>
                                <th class="text-center text-primary">DATE</th>
                                <th class="text-center text-primary">ACTIONS</th>
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
                                        <p>{{ $request->user->client->fist_name }}{{ $request->user->client->last_name }}</p>
                                    </td>
                                    <td class="product-des" data-title="Détails">
                                        <p class="product-name"><strong>{{ $request->title }}</strong></p>
                                       
                                       
                                     
                                    </td>
                                    <td class="price" data-title="Statut">
                                        @if ($request->status == 'pending')
                                            <span class="badge badge-pending">En attente</span>
                                       
                                        @elseif ($request->status == 'under_review')
                                            <span class="badge badge-under_review">En cours de traitement</span>
                                        @elseif ($request->status == 'approved')
                                            <span class="badge badge-approved">Traiter</span>
                                            
                                        @endif
                                    </td>
                                    <td class="contract" data-title="Contrat">
                                     {{ date('Y-m-d', strtotime($request->created_at)) }}
                                    </td>
                                    <td class="action">
                                        <span>
                                            <a href="{{ route('projects.show', $request->id) }}" class="btn btn-sm btn-outline-primary"><i class="ti-eye"></i> Voir</a>
                                          
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                   {{--    {{ $requests->links('pagination::bootstrap-5') }} --}}
                    </div>
                @else
                    <div class="alert alert-info">Aucun Projet trouvé</div>
                @endif
            </div>
        </div>
    </div>
</div>

        </div><!-- END ROW-->
    </div>



@endsection

@section('extra-scripts')
    
    <script src="{{asset('clients/assets/js/nicesellect.js?'.Str::uuid())}}"></script>
    <script type="text/javascript">
        $('select').niceSelect();
  

@endsection
