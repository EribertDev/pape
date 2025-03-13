@extends('clients.master-1')
@section('extra-style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">



<!-- Script JS pour AOS -->


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
                          
                           
                        />
                        <button class="btn btn-primary" type="button">
                            <i class="bi bi-search"></i> <!-- Icône de recherche -->
                        </button>
                                         
                       
                    </div>
                </div>
                <div class="row mb-3 g-3 mt-3">
       
                    <div class="row mb-5 g-3 mt-2 justify-content-center">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="bg-light p-4 rounded-4 shadow-sm">
                                <div class="text-center mb-3">
                                    <label for="statusFilter" class="form-label fw-bold text-secondary">Choisir une discipline</label>
                                </div>
                                <select class="form-select form-select-lg border-2 border-primary rounded-3 shadow-sm py-3 fs-5" 
                                        name="discipline" 
                                        id="statusFilter"
                                        style="cursor: pointer;">
                                    @foreach($disciplines as $discipline)
                                    <option value="{{ $discipline->id }}">{{ $discipline->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
               <!-- Filtres -->
 
            <h1 class="text-center my-5 fw-bold">Thèmes de Mémoire Disponibles</h1>
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#favoritesModal">
                Mes Favoris
            </button>
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
                                    <p class="card-text"><strong>Description :</strong> {{ Str::limit($theme->description, 30) }}</p>
        
                                    <div class="mt-auto">
                                        <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#themeModal{{ $theme->id }}">
                                            Voir Plus
                                        </button>
                                        <button 
                                            class="favorite-btn" 
                                            data-id="{{ $theme->id }}" 
                                            data-title="{{ $theme->title }}"
                                            data-description="{{ $theme->description }}">
                                            <i class="bi bi-heart"></i> <!-- Icône cœur vide -->
                                        </button>
                                    </div>
                                     <!-- Bouton Favoris -->
                                    
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


     
        
        <div class="modal fade" id="favoritesModal" tabindex="-1" aria-labelledby="favoritesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="favoritesModalLabel">Mes Favoris</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul id="favoritesList" class="list-group"></ul>
                    </div>
                </div>
            </div>
        </div>
        
    <!--END COURSE -->

@endsection

@section('extra-scripts')
<script>
    function updateFavoriteButtons() {
    const favoriteButtons = document.querySelectorAll('.favorite-btn');

    // Initialiser le localStorage pour les favoris
    let favorites = JSON.parse(localStorage.getItem('favorites')) || [];

    favoriteButtons.forEach(button => {
        const themeId = button.getAttribute('data-id');

        // Vérifiez si le thème est dans les favoris et mettez à jour l'icône
        if (favorites.includes(themeId)) {
            button.innerHTML = '<i class="bi bi-heart-fill text-danger"></i>';
        } else {
            button.innerHTML = '<i class="bi bi-heart"></i>';
        }

        // Ajouter ou retirer des favoris
        button.addEventListener('click', () => {
            if (favorites.includes(themeId)) {
                favorites = favorites.filter(fav => fav !== themeId); // Retirer des favoris
                button.innerHTML = '<i class="bi bi-heart"></i>';
            } else {
                favorites.push(themeId); // Ajouter aux favoris
                button.innerHTML = '<i class="bi bi-heart-fill text-danger"></i>';
            }
            localStorage.setItem('favorites', JSON.stringify(favorites)); // Sauvegarder les favoris dans le LocalStorage
        });
    });
}

function searchThemes() {
    const query = document.getElementById('searchBar').value; // Valeur de recherche
    const themesContainer = document.getElementById('themesContainer');

    // Ajouter un indicateur de chargement avant de lancer la requête
    themesContainer.innerHTML = `
        <div class="text-center my-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Chargement...</span>
            </div>
            <p class="text-muted">Recherche en cours...</p>
        </div>
    `;

    fetch(`/search-themes?query=${encodeURIComponent(query)}`, {
        method: 'GET',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
    })
    .then((response) => {
        if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
        return response.json();
    })
    .then((data) => {
        themesContainer.innerHTML = ''; // Vider le conteneur avant d'ajouter des résultats

        if (data.length > 0) {
            // Insérer chaque thème dans le conteneur
            data.forEach((theme) => {
                let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
                let heartIcon = favorites.includes(theme.id.toString()) ?
                    '<i class="bi bi-heart-fill text-danger"></i>' : 
                    '<i class="bi bi-heart"></i>';
                let themeCard = `
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4 theme-card">
                        <div class="card shadow-sm h-100">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-primary">${theme.title}</h5>
                                <p class="card-text"><strong>Description :</strong> 
                                    ${theme.description ? theme.description.substring(0, 30) + '...' : 'Aucune description disponible.'}
                                </p>
                                <div class="mt-auto">
                                    <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#themeModal${theme.id}">
                                        Voir Plus
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger favorite-btn" data-id="${theme.id}">
                                        ${heartIcon}
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
                                        <p><strong>Description :</strong> ${theme.description || "Pas de description disponible."}</p>
                                        <hr>
                                        <p><strong>Objectifs Générales :</strong> ${theme.generale || "Non spécifié."}</p>
                                        <hr>
                                        <p><strong>Objectifs Spécifiques :</strong> ${theme.specifique || "Non spécifié."}</p>
                                        <hr>
                                        <p><strong>Lieu de collecte :</strong> ${theme.lieu_collect || "Non spécifié."}</p>
                                        <hr>
                                        <p><strong>Années de Collecte :</strong> ${theme.annee_collect || "Non spécifié."}</p>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                themesContainer.innerHTML += themeCard;
               
            }); 

        } else {
            themesContainer.innerHTML = `
                <div class="d-flex flex-column align-items-center justify-content-center text-center mt-5">
                    <div class="mb-3">
                        <i class="fas fa-sad-tear" style="font-size: 6rem; color: #f06c64;"></i>
                    </div>
                    <h4 class="fw-bold text-danger">Aucun thème trouvé</h4>
                    <p class="text-muted mb-4">
                        Désolé, aucun thème correspondant n'a été trouvé.<br>
                        Essayez avec d'autres mots-clés ou vérifiez l'orthographe.
                    </p>
                </div>`;
        }
        updateFavoriteButtons(); 
    })
    .catch((error) => {
        themesContainer.innerHTML = `
            <div class="alert alert-danger" role="alert">
                Une erreur s'est produite lors de la recherche. Veuillez réessayer plus tard.
            </div>`;
        console.error('Erreur lors du fetch :', error);
    });
}


 document.getElementById('searchBar').addEventListener('input', searchThemes);

 document.addEventListener("DOMContentLoaded", () => {

    const favoriteButtons = document.querySelectorAll('.favorite-btn');

    // Initialiser les favoris dans le LocalStorage
    let favorites = JSON.parse(localStorage.getItem('favorites')) || [];

    // Afficher les favoris au chargement
    favoriteButtons.forEach(button => {
        const themeId = button.getAttribute('data-id');

        if (favorites.includes(themeId)) {
            button.innerHTML = '<i class="bi bi-heart-fill text-danger"></i>'; // Icône remplie si favori
        }
       

        // Ajouter ou retirer un thème des favoris
        button.addEventListener('click', () => {
            if (favorites.includes(themeId)) {
                favorites = favorites.filter(fav => fav !== themeId); // Supprimer des favoris
                button.innerHTML = '<i class="bi bi-heart"></i>'; // Icône vide
            } else {
                favorites.push(themeId); // Ajouter aux favoris
                button.innerHTML = '<i class="bi bi-heart-fill text-danger"></i>'; // Icône remplie
            }
            localStorage.setItem('favorites', JSON.stringify(favorites)); // Sauvegarde
        });
    });

    const modalList = document.getElementById('favoritesList');
    const favoritesModal = document.getElementById('favoritesModal');

    // Afficher la liste des favoris dans la modale
    favoritesModal.addEventListener('show.bs.modal', () => {
        const storedFavorites = JSON.parse(localStorage.getItem('favorites')) || [];
        modalList.innerHTML = ''; // Réinitialiser le contenu de la liste

        if (storedFavorites.length === 0) {
            modalList.innerHTML = `
                <li class="list-group-item text-center">
                    <p class="text-muted">Aucun favori pour le moment.</p>
                </li>`;
            return;
        }

        fetch('/themes') // Charger tous les thèmes disponibles
            .then(response => response.json())
            .then(themes => {
                storedFavorites.forEach(id => {
                    const theme = themes.find(theme => theme.id === Number(id)); // Trouver le thème correspondant

                    if (theme) {
                        const listItem = `
                            <li class="list-group-item">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold text-primary">${theme.title}</h5>
                                        <p class="card-text">Description: ${theme.description || 'Aucune description disponible.'}</p>
                                        <div class="d-flex justify-content-between mt-3">
                                            <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#themeModal${theme.id}">
                                                Voir Plus
                                            </button>
                                            <button class="btn btn-sm btn-danger remove-favorite" data-id="${theme.id}">
                                                Retirer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>`;
                        modalList.innerHTML += listItem;
                    }
                });

                // Ajouter la fonctionnalité pour retirer les favoris
                const removeButtons = modalList.querySelectorAll('.remove-favorite');
                removeButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const idToRemove = button.getAttribute('data-id');
                        favorites = favorites.filter(fav => fav !== idToRemove); // Retirer du tableau des favoris
                        localStorage.setItem('favorites', JSON.stringify(favorites)); // Mise à jour du stockage
                        button.closest('li').remove(); // Supprimer du DOM
                    });
                });
            })
            .catch(error => console.error('Erreur lors de la récupération des thèmes :', error));
    });
});

document.getElementById('statusFilter').addEventListener('change', () => {
    const selectedDiscipline = document.getElementById('statusFilter').value;
    const themesContainer = document.getElementById('themesContainer');

    themesContainer.innerHTML = `
        <div class="text-center my-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Chargement...</span>
            </div>
            <p class="text-muted">Chargement des thèmes...</p>
        </div>
    `;

    fetch(`/themes-by-discipline?discipline_id=${selectedDiscipline}`, {
        method: 'GET',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
    })
    .then(response => {
        if (!response.ok) throw new Error(`Erreur HTTP! Statut : ${response.status}`);
        return response.json();
    })
    .then(data => {
        themesContainer.innerHTML = '';

        if (data.length > 0) {
            data.forEach(theme => {
                let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
                let heartIcon = favorites.includes(theme.id.toString()) ?
                    '<i class="bi bi-heart-fill text-danger"></i>' : 
                    '<i class="bi bi-heart"></i>';
                let themeCard = `
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4 theme-card">
                        <div class="card shadow-sm h-100">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title>
                                fw-bold text-primary">${theme.title}</h5>
                                <p class="card-text"><strong>Description :</strong> 
                                    ${theme.description ? theme.description.substring(0, 30) + '...' : 'Aucune description disponible.'}    
                                </p>
                                <div class="mt-auto">
                                    <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#themeModal${theme.id}">
                                        Voir Plus
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger favorite-btn" data-id="${theme.id}">
                                        ${heartIcon}
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
                                        <p><strong>Description :</strong> ${theme.description || "Pas de description disponible."}</p>
                                        <hr>
                                        <p><strong>Objectifs Générales :</strong> ${theme.generale || "Non spécifié."}</p>
                                        <hr>
                                        <p><strong>Objectifs Spécifiques :</strong> ${theme.specifique || "Non spécifié."}</p>
                                        <hr>
                                        <p><strong>Lieu de collecte :</strong> ${theme.lieu_collect || "Non spécifié."}</p>
                                        <hr>
                                        <p><strong>Années de Collecte :</strong> ${theme.annee_collect || "Non spécifié."}</p>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                themesContainer.innerHTML += themeCard;
               
            }); 
        } else {
            themesContainer.innerHTML = `
                <div class="d-flex flex-column align-items-center justify-content-center text-center mt-5">
                    <div class="mb-3">
                        <i class="fas fa-sad-tear" style="font-size: 6rem; color: #f06c64;"></i>
                    </div>
                    <h4 class="fw-bold text-danger">Aucun thème trouvé</h4>
                    <p class="text-muted mb-4">
                        Désolé, aucun thème correspondant n'a été trouvé pour cette discipline .<br>
                    </p>
                </div>`;
        }
        updateFavoriteButtons(); 
    })
    .catch((error) => {
        themesContainer.innerHTML = `
            <div class="alert alert-danger" role="alert">
                Une erreur s'est produite lors de la recherche. Veuillez réessayer plus tard.
            </div>`;
        console.error('Erreur lors du fetch :', error);
    });
});





</script>



@endsection
