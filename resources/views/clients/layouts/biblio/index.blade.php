@extends('clients.master-1')
@section('extra-style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
       .input-group input {
    border-top-left-radius: 25px;
    border-bottom-left-radius: 25px;
}

.input-group button {
    border-top-right-radius: 25px;
    border-bottom-right-radius: 25px;
    padding: 0.5rem 1.5rem;
}

.input-group input:focus {
    box-shadow: 0 4px 10px rgba(0, 123, 255, 0.25);
}

    .card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }
</style>
@endsection

@section('page-content')
    <!-- START SECTION TOP -->
    <section class="section-top">
        <div class="container">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                    <i class="fas fa-folder-open"></i>  <h1>Bibliothèque CESIE</h1>
                    <ul>
                        <li><a href="">Nos Thèmes</a></li>
                      
                    </ul>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->   
    </section>
    <!-- END SECTION TOP -->

    <!--START COURSE -->
    <div class="best-cpurse section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="input-group">
                        <input 
                            type="text" 
                            id="searchBar" 
                            class="form-control border-end-0" 
                            placeholder="Recherchez un thème..." 
                            onkeyup="searchThemes()" 
                        />
                        <button class="btn btn-primary" type="button">
                            <i class="bi bi-search"></i> <!-- Icône de recherche -->
                        </button>
                    </div>
                </div>
            </div>
            <h1 class="text-center my-5 fw-bold">Thèmes de Mémoire Disponibles</h1>
        
            @if ($themes->isEmpty())
                <div class="alert alert-info text-center">
                    <strong>🤔 Aucun thème disponible pour le moment. Revenez plus tard.</strong>
                </div>
            @else
                <div class="row" id="themesContainer">
                    @foreach ($themes as $theme)
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold text-primary">{{ $theme->title }}</h5>
                                    <p class="card-text"><strong>Description :</strong> {{ Str::limit($theme->description, 100) }}</p>
        
                                    <div class="mt-auto">
                                        <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#themeModal{{ $theme->id }}">
                                            Voir Plus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <!-- Modal -->
                        <div class="modal fade" id="themeModal{{ $theme->id }}" tabindex="-1" aria-labelledby="themeModalLabel{{ $theme->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold" id="themeModalLabel{{ $theme->id }}">{{ $theme->title }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Description :</strong> {{ $theme->description }}</p>
                                        <hr>
                                        <p><strong>Objectifs Générales :</strong> {{ $theme->generale }}</p>
                                        <hr>
                                        <p><strong>Objectifs Spécifiques :</strong> {{ $theme->specifique }}</p>
                                        <hr>
                                        <p><strong>Lieu de collecte  :</strong> {{ $theme->lieu_collect }}</p>
                                        <hr>
                                        <p><strong>Années de Collecte :</strong> {{ $theme->annee_collect }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    <!--END COURSE -->

@endsection

@section('extra-scripts')

<script>
    function searchThemes() {
        const query = document.getElementById('searchBar').value;

        fetch(`/search/themes?query=${encodeURIComponent(query)}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
        })
        .then(response => response.json())
        .then(data => {
            const themesContainer = document.getElementById('themesContainer');
            themesContainer.innerHTML = ''; // Efface l'affichage actuel

            if (data.length === 0) {
                themesContainer.innerHTML = `
        <div class="d-flex flex-column align-items-center justify-content-center py-5">
            <i class="bi bi-emoji-frown display-3 text-muted mb-3"></i>
            <h5 class="text-muted">Aucun thème trouvé</h5>
            <p class="text-muted">Essayez avec d'autres mots-clés.</p>
        </div>
    `;
    return;
            }

            // Ajouter les cartes dynamiquement
            data.forEach(theme => {
                const cardHTML = 
                `<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold text-primary">${theme.title}</h5>
                                    <p class="card-text"><strong>Description :</strong>${theme.description}</p>
        
                                    <div class="mt-auto">
                                       <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#themeModal${theme.id}">
                                        Voir Plus
                                    </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- Modal Dynamique -->
                    <div class="modal fade" id="themeModal${theme.id}" tabindex="-1" aria-labelledby="themeModalLabel${theme.id}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold" id="themeModalLabel${theme.id}">${theme.title}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ${theme.description ? `<p><strong>Description :</strong> ${theme.description}</p><hr>` : ''}
                                    ${theme.generale ? `<p><strong>Objectifs Générales :</strong> ${theme.generale}</p><hr>` : ''}
                                    ${theme.specifique ? `<p><strong>Objectifs Spécifiques :</strong> ${theme.specifique}</p><hr>` : ''}
                                    ${theme.lieu_collect ? `<p><strong>Lieu de collecte :</strong> ${theme.lieu_collect}</p><hr>` : ''}
                                    ${theme.annee_collect ? `<p><strong>Années de Collecte :</strong> ${theme.annee_collect}</p>` : ''}
                                </div>
                            </div>
                        </div>
                    </div>
                    `;

                  
                themesContainer.innerHTML += cardHTML;
            });
        })
        .catch(error => console.error('Erreur:', error));
    }
</script>

@endsection
