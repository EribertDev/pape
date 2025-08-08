@extends('clients.master-1')
@section('extra-style')
     <script src="https://cdn.tailwindcss.com"></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

body {
    font-family: 'Inter', sans-serif;
}

.rounded-2xl {
    border-radius: 1.5rem;
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
                        <li class="fw-bold">Messages</li>
                    </ul>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>






<div class="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-100 py-8 px-4 sm:px-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-indigo-900 mb-2">Mon Espace Message</h1>
            <p class="text-lg text-indigo-700">Bienvenue, {{ Auth::user()->email}}</p>
            <div class="w-24 h-1 bg-indigo-500 mx-auto mt-4 rounded-full"></div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500">Documents</p>
                        <p class="text-2xl font-bold">{{ $documents->where('type', 'file')->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500">Messages</p>
                        <p class="text-2xl font-bold">{{ $documents->where('type', 'information')->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 rounded-lg mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-500">Dernière activité</p>
                        <p class="text-xl font-bold">{{ $documents->last()->created_at->diffForHumans()}}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Documents Section -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-indigo-700 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                            </svg>
                            Mes Documents Partagés
                        </h2>
                    </div>
                    
                    <div class="p-6">
                        @if($documents->isEmpty())
                            <div class="text-center py-10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="mt-4 text-gray-500">Aucun document partagé pour le moment</p>
                            </div>
                        @else
                            <div class="space-y-4">
                                @foreach($documents as $doc)
                                <div class="flex items-start p-4 border border-gray-200 rounded-xl hover:bg-indigo-50 transition-colors">
                                    <div class="mr-4 mt-1">
                                        @if($doc->type === 'file')
                                        <div class="bg-blue-100 p-3 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        @elseif($doc->type === 'link')
                                        <div class="bg-green-100 p-3 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                            </svg>
                                        </div>
                                        @else
                                        <div class="bg-purple-100 p-3 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        @endif
                                    </div>
                                    
                                    <div class="flex-1">
                                        <h3 class="font-bold text-lg text-gray-800">{{ $doc->title }}</h3>
                                        <p class="text-gray-500 text-sm mt-1">
                                            Ajouté le {{ $doc->created_at->format('d/m/Y') }}
                                            @if($doc->is_global) • <span class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full text-xs">Public</span> @endif
                                        </p>
                                        
                                        @if($doc->type === 'file')
                                        <div class="mt-3 flex items-center">
                                            <span class="text-gray-500 mr-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                            </span>
                                            <a href="{{ Storage::url($doc->path) }}" download="{{ $doc->original_name }}" class="text-blue-600 hover:underline">
                                                Télécharger le fichier
                                            </a>
                                        </div>
                                        @elseif($doc->type === 'link')
                                        <div class="mt-3">
                                            <a href="{{ $doc->path }}" target="_blank" class="inline-flex items-center text-blue-600 hover:underline">
                                                <span class="mr-1">Visiter le lien</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                </svg>
                                            </a>
                                        </div>
                                        @else
                                        <div class="mt-3 bg-gray-50 p-3 rounded-lg border border-gray-100">
                                            <p class="text-gray-700">{{ $doc->content }}</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Messages & Info -->
            <div class="space-y-8">
             
              
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script src="https://cdn.tailwindcss.com"></script>

@endsection