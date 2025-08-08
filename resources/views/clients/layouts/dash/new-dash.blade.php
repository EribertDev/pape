@extends('clients.master-1')
@section('extra-style')
    <link rel="stylesheet" href="{{asset('clients/assets/css/niceselect.css')}}"/>
    <link rel="stylesheet" href="{{asset(('clients/assets/css/shop.css'))}}"/>
    <link rel="stylesheet" href="{{asset(('clients/assets/css/styles_perso.css'))}}"/>
    <link rel="stylesheet" href="{{asset(('clients/assets/css/profile.css'))}}"/>
    <link rel="stylesheet" href="{{asset(('clients/assets/css/btn-groupe.css'))}}"/>
    <link rel="stylesheet" href="{{asset(('sclients/assets/css/dash.css'))}}"/>
    <link rel="stylesheet" href="{{asset(('stdev/css/badge-status.css'))}}"/>

    <link rel="stylesheet" href="{{asset(('stdev/css/style.css'))}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        light: '#f6f8ff'
                    }
                }
            }
        }
    </script>
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

  </style>

@endsection

@section('page-content')
<body class="bg-gray-50">
    <!-- Navigation Mobile -->
    <div class="mobile-nav fixed bottom-0 left-0 right-0 bg-white shadow-lg z-50 md:hidden">
        <div class="flex justify-around py-3">
            <a href="{{route('dash.client')}}" class="text-primary flex flex-col items-center" style="margin-right: 30px;">
                <i class="fas fa-home text-lg mb-1"></i>
                <span class="text-xs">Mon Espace</span>
            </a>
            <a href="{{route('dash.commande')}}" class="text-gray-500 flex flex-col items-center" style="margin-right: 30px;">
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

    <div class="flex min-h-screen">
        <!-- Sidebar Desktop -->
        <div class="desktop-sidebar w-64 bg-white shadow-md fixed h-full hidden md:block" style="margin-top: 70px;">
            <div class="p-6 border-b border-gray-100">
                <h1 class="text-2xl font-bold text-primary">Mon Espace</h1>
            </div>
            
            <div class="p-4 flex items-center mt-6">
                <div class="relative">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-r from-primary to-secondary flex items-center justify-center">
                        <span class="text-white text-xl font-bold"> {{ substr(session('clientInfo')->last_name, 0, 1) }}</span>
                    </div>
                    <div class="absolute bottom-0 right-0 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></div>
                </div>
                <div class="ml-3">
                    <h3 class="font-semibold text-gray-800">{{ session('clientInfo')->fist_name }} {{ session('clientInfo')->last_name }}</h3>
                </div>
            </div>
            
            <div class="mt-8 px-2">
                <a href="{{route('dash.client')}}" class="sidebar-link active flex items-center px-4 py-3 mb-2">
                    <i class="fas fa-home mr-3 text-primary"></i>
                    <span>Tableau de bord</span>
                </a>
                <a href="{{route('dash.commande')}}" class="sidebar-link flex items-center px-4 py-3 mb-2">
                    <i class="fas fa-file-alt mr-3 text-gray-500"></i>
                    <span>Mes commandes</span>
                    <span class="ml-auto bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">{{ $commandes->where('status_name', '!=', 'Terminé')->count() }}</span>
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
               
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="flex-1 md:ml-64">
            <!-- Header -->
            <header class="bg-white shadow-sm">
                <div class="flex justify-between items-center p-4" style="margin-top: 60px;" >
                    <div class="flex items-center">
                        <button class="md:hidden text-gray-600 mr-4">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="text-xl font-bold text-gray-800">Tableau de bord</h1>
                    </div>
                    <div class="flex items-center">
                        <div class="relative mr-4">
                            <button class="text-gray-500 relative">
                                <i class="fas fa-bell text-xl"></i>
                                <span class="notification-dot">3</span>
                            </button>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-700 font-bold">{{ substr(session('clientInfo')->fist_name, 0, 1) }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <main class="p-4 md:p-6">
                <!-- Section de bienvenue -->
                <div class="bg-gradient-to-r from-primary to-dark rounded-2xl p-6 text-white mb-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h2 class="text-2xl font-bold mb-2">Bonjour {{ session('clientInfo')->fist_name }} 👋</h2>
                            <p class="mb-4 max-w-2xl">Bienvenue dans votre espace client. Vous avez {{ $commandes->where('status_name', '!=', 'Terminé')->count() }} commandes en cours et {{$projet_en_cours->count()}} projets en cours. Consultez vos dernières activités ci-dessous.</p>
                            <a href="{{route('redaction.offers')}}" class="inline-block bg-white text-primary font-medium px-5 py-2 rounded-lg hover:bg-gray-100 transition">
                                Commander maintenant
                            </a>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <div class="w-24 h-24 mx-auto md:mx-0 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-rocket text-4xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistiques rapides -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="dashboard-card stat-card orders bg-white p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500">Commandes</p>
                                <h3 class="text-2xl font-bold mt-2">{{ $commandes->count() }}</h3>
                            </div>
                            <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-shopping-cart text-blue-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex justify-between text-sm mb-1">
                                <span>En cours</span>
                                <span>{{ $commande_en_cours->count() }}</span>
                            </div>
                            
                        </div>
                    </div>

                    <div class="dashboard-card stat-card projects bg-white p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500">Projets</p>
                                <h3 class="text-2xl font-bold mt-2">{{ $projets->count() }}</h3>
                            </div>
                            <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center">
                                <i class="fas fa-project-diagram text-green-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex justify-between text-sm mb-1">
                                <span>Actifs</span>
                                <span>  {{ $projets_actifs->count() }} </span>
                            </div>
                           
                        </div>
                    </div>

                    <div class="dashboard-card stat-card internships bg-white p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500">Stages</p>
                                <h3 class="text-2xl font-bold mt-2">{{ $stages->count() }}</h3>
                            </div>
                            <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center">
                                <i class="fas fa-graduation-cap text-purple-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex justify-between text-sm mb-1">
                                <span>En cours</span>
                                <span>{{ $stages_en_cours->count() }}</span>
                            </div>
                          
                        </div>
                    </div>

                    <div class="dashboard-card stat-card messages bg-white p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500">Messages</p>
                                <h3 class="text-2xl font-bold mt-2">{{ $nouveaux_messages->count() }}</h3>
                            </div>
                            <div class="w-12 h-12 rounded-lg bg-yellow-100 flex items-center justify-center">
                                <i class="fas fa-comments text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex justify-between text-sm mb-1">
                                <span>Nouveaux</span>
                                <span>{{ $nouveaux_messages->where('type', 'information')->count() }}</span>
                            </div>
                            <div class="progress-bar bg-gray-200">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Dernières commandes -->
                    <div class="dashboard-card bg-white">
                        <div class="p-5 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="font-semibold text-lg text-gray-800">Dernières commandes</h3>
                            <a href="{{route('dash.commande')}}" class="text-sm text-primary hover:underline">Voir tout</a>
                        </div>
                        <div class="p-4">
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="text-left text-gray-500 text-sm">
                                            <th class="pb-3">Description</th>
                                            <th class="pb-3">Statut</th>
                                            <th class="pb-3">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($commandes->take(3) as $commande)
                                            @php
                                               
                                            $badge ='badge-'.$commande->status_name;
                                            $badge = strtolower($badge);
                                            $badge = str_replace(array(' ', 'é'), array('-', 'e'), $badge);
                                       
                                               
                                            @endphp
                                            <tr class="border-b border-gray-100">
                                                <td class="py-4">
                                                    <p class="font-medium text-gray-800">{{ Str::limit($commande->subject, 25) }}</p>
                                                    <p class="text-sm text-gray-500 mt-1">{{ Str::limit($commande->description, 35) }}</p>
                                                </td>
                                                <td>
                                                    <span class="badge {{$badge}}">{{ $commande->status_name }}</span>
                                                </td>
                                                <td>
                                                    <div class="flex space-x-3">
                                                        @if ($commande->status_name === 'Terminé')
                                                            <a href="#" class="text-blue-500 hover:text-blue-700" data-uuid="{{$commande->uuid}}">
                                                                <i class="fas fa-download"></i>
                                                            </a>
                                                        @endif
                                                        <a href="{{route('dash.client.commande.detail',['uuid' => $commande->uuid])}}" class="text-gray-500 hover:text-gray-700">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Projets en cours -->
                    <div class="dashboard-card bg-white">
                        <div class="p-5 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="font-semibold text-lg text-gray-800">Projets en cours</h3>
                            <a href="{{route('projects.dash')}}" class="text-sm text-primary hover:underline">Voir tout</a>
                        </div>
                        <div class="p-4">
                            <div class="space-y-4">
                               @forEach($projets as $project)
                               <div class="border border-gray-100 rounded-xl p-4">
                                    <div class="flex justify-between">
                                        <h4 class="font-medium text-gray-800">{{$project->title}}</h4>
                                        @if ($project->status == 'pending')
                                            <span class="badge badge-pending text-black">En attente</span>
                                       
                                        @elseif ($project->status == 'under_review')
                                            <span class="badge badge-under_review text-black">En cours de traitement</span>
                                        @elseif ($project->status == 'approved')
                                            <span class="badge badge-approved text-black">Traiter</span>
                                            
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-500 mt-2">{{$project->problem}}</p>
                                    <div class="mt-4">
                                        <div class="flex justify-between text-sm mb-1">
                                            <span>Budget</span>
                                            <span>{{$project->budget}} FCFA</span>
                                        </div>
                                       
                                    </div>
                                </div>
                                @endforEach
                             
                            </div>
                        </div>
                    </div>


                    <!-- Stages en cours -->
                    
                    <div class="dashboard-card bg-white">
                        <div class="p-5 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="font-semibold text-lg text-gray-800">Demandes de stage</h3>
                            <a href="{{route('internships.dash')}}" class="text-sm text-primary hover:underline">Voir tout</a>
                        </div>
                        <div class="p-4">
                            <div class="space-y-4">
                                @foreach($stages as $request)
                                <div class="border border-gray-100 rounded-xl p-4">
                                    <div class="flex justify-between">
                                        <h4 class="font-medium text-blue-600" >{{ $request->user->client->fist_name }} {{ $request->user->client->last_name }}</h4>
                                        @if ($request->status == 'pending')
                                            <span class="badge badge-pending">Contrat en attente de signature</span>
                                        @elseif ($request->status == 'under_review')
                                            <span class="badge badge-under_review">En cours de traitement</span>
                                        @elseif ($request->status == 'approved')
                                            <span class="badge badge-approved">Accepté</span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-500 mt-2">
                                        {{ $request->university }} - {{ $request->field }} ({{ $request->level }})
                                    </p>
                                    <p class="text-sm text-gray-500">{{ $request->company }}, {{ $request->commune }}</p>
                                    
                                    @if($request->binome)
                                    <p class="text-xs text-gray-500 mt-1">Binôme: {{ $request->binome }}</p>
                                    @endif

                                                                   
                                
                                </div>
                                @endforeach
                                
                                @if(count($stages) === 0)
                                <div class="text-center py-6 text-gray-500">
                                    Aucune demande de stage enregistrée
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                   
                </div>
            </div>
        </div>
                </div>

              
            </main>
        </div>
    </div>

    <!-- Bouton flottant pour nouvelle commande -->
    <a href="{{route('redaction.offers')}}" class="floating-btn w-14 h-14 bg-primary rounded-full flex items-center justify-center text-white text-xl hover:bg-secondary transition">
        <i class="fas fa-plus"></i>
    </a>
@endsection

@section('extra-scripts')
    
    <script src="{{asset('clients/assets/js/nicesellect.js?'.Str::uuid())}}"></script>
    <script type="module" src="{{asset('clients/js-data/dash.js?'.Str::uuid())}}"></script>
        <script type="text/javascript">
        $('select').niceSelect();
    </script>
    <script>
       
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.dashboard-card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    card.style.transition = 'opacity 0.9s ease, transform 0.5s ease';
                    
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 100);
                }, index * 100);
            });
        });
    </script>
    
@endsection
