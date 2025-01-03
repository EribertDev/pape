@extends('clients.master-1')
@section('extra-style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->

<style>
       

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
            <h1 class="text-center my-5 fw-bold">Thèmes de Mémoire Disponibles</h1>
        
            @if ($themes->isEmpty())
                <div class="alert alert-info text-center">
                    <strong>🤔 Aucun thème disponible pour le moment. Revenez plus tard.</strong>
                </div>
            @else
                <div class="row">
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

    </script>

@endsection
