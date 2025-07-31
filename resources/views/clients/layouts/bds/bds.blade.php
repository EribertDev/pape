@extends('clients.master-1')
@section('extra-style')
    <!-- MAGNIFIC CSS -->
    <link rel="stylesheet" href="{{asset('clients/assets/css/niceselect.css')}}" />
    <link rel="stylesheet" href="{{asset(('clients/assets/css/shop.css'))}}" />
    <link rel="stylesheet" href="{{asset(('clients/assets/css/styles_perso.css'))}}" />
    <link rel="stylesheet" href="{{asset('clients/js-simple-loader-main/loader.css')}}" />
    <script  src="{{asset('clients/js-simple-loader-main/loader.js')}}"  ></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

@endsection

@section('page-content')
    <section class="section-top">
        <div class="container">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0" style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInRight;">
                    <h1>Boutique de Base de Données</h1>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>
    <section id="product_area" class="section-padding">
        <div class="container">
            <div class="text-center">
                <div class=" mb-5">
            <form id="priceFilterForm" class="banner_subs">
                <h2 class="text-center">Trier par Prix</h2>
                <div class="row align-items-center">
              
                    <div class="col-md-4 mb-2 mb-md-0">
                        <input type="number" name="min_price" class="form-control home_si" placeholder="Prix min (F CFA)" min="0">
                    </div>
                    <div class="col-md-4 mb-2 mb-md-0">
                        <input type="number" name="max_price" class="form-control home_si" placeholder="Prix max (F CFA)" min="0">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel me-1"></i> Filtrer
                        </button>
                            <button type="button" class="btn btn-outline-secondary reset-price-filter">
                            <i class="bi bi-arrow-counterclockwise"></i> Réinitialiser
                        </button>
                    </div>
                </div>
            </form>
        </div>
               {{-- <div class="product_filter">
                    <ul>
                        <li class="filter active" data-filter="all">All</li>
                        <li class="filter" data-filter=".sale">Sale</li>
                        <li class="filter" data-filter=".bslr">Bestseller</li>
                        <li class="filter" data-filter=".ftrd">Featured</li>
                    </ul>
                </div>--}}

                <div class="product_item" id="MixItUp59A9D5">
                    @if(!empty($bds))
                        <section id="product_area" class="section-padding">
                            <div class="container">
                                <div class="text-center">
                                    <div class="product_item" id="product_item">
                                        <div class="row">
                                            @foreach($bds as $db)
                                                <div class="col-lg-3 col-md-4 col-sm-6 mix" style="display: inline-block;" data-bound="" >
                                                    <div class="product-grid border border-0 rounded-3 shadow-lg" >
                                                        <div class="product-image">
                                                            <a href="#">
                                                                <img class="pic-1" src="{{asset('clients/assets/images/shop/9.jpg')}}"
                                                                     alt="product image">
                                                                <img class="pic-2" src="{{asset('clients/assets/images/shop/10.jpg')}}"
                                                                     alt="product image">
                                                            </a>

                                                            <ul class="social">
                                                                <li>
                                                                    <a  href="{{route('bd.detail',["uuid"=>$db->uuid,"fakeUuid"=>Str::uuid()])}}"  {{--onclick="event.preventDefault();this.closest('form').submit();"--}} data-tip="Voir">
                                                                        <i class="ti-eye"></i>
                                                                    </a>
                                                                    {{--<form action="{{route('bd.detail')}}" method="POST">
                                                                        @csrf
                                                                        <!-- Remplacez '123' par l'ID de produit approprié -->
                                                                        <input type="hidden" name="bd_uuid" value="{{$db->uuid}}">

                                                                    </form>--}}
                                                                </li>
                                                            </ul>
                                                            <span class="product-new-label">Nouveau</span>
                                                        </div>
                                                        {{-- <ul class="rating">
                                                             <li class="fa fa-star"></li>
                                                             <li class="fa fa-star"></li>
                                                             <li class="fa fa-star"></li>
                                                             <li class="fa fa-star"></li>
                                                             <li class="fa fa-star disable"></li>
                                                         </ul>--}}
                                                        <div class="product-content">
                                                            <h3 class="title"><a href="#">{{$db->name}}</a></h3>
                                                            <div class="price">{{ number_format($db->amount, 0, ',', '.') . ' F CFA (XOF)' }}
                                                            </div>
                                                            <div >
                                                                <a href="{{route('bd.detail',["uuid"=>$db->uuid,"fakeUuid"=>Str::uuid()])}}" 
                                                                    class="btn btn-primary fw-bold mb-4 px-4 py-2 d-flex align-items-center justify-content-center payer-link fw-bold commande-bd"
                                                                    style="border-radius: 25px; background: linear-gradient(to right, #6a11cb, #2575fc); color: #fff; transition: all 0.3s ease; text-decoration: none; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                                                                    <i class="bi bi-cart-plus me-2"></i>
                                                                    Commander
                                                                 </a>
                                                                 
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div>
                                                {{ $bds->links('pagination::bootstrap-5') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra-scripts')
    <script type="module" src="{{asset('clients/js-data/bd.js')}}" ></script>
   <script>
$(document).ready(function() {
    // Gestion de la soumission du formulaire
    $('#priceFilterForm').on('submit', function(e) {
        e.preventDefault();
        
        const formData = $(this).serialize();
        
        // Afficher un indicateur de chargement
        $('#product_item').html(`
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Chargement...</span>
                </div>
                <p class="mt-2">Filtrage en cours...</p>
            </div>
        `);
        
        // Requête AJAX
        $.ajax({
            url: '{{ route("bds.filter") }}',
            type: 'GET',
            data: formData,
            success: function(response) {
                $('#product_item').html(response.html);
                
                // Mettre à jour la pagination si nécessaire
                if(response.pagination) {
                    $('.pagination-container').html(response.pagination);
                }
            },
            error: function(xhr) {
                $('#product_item').html(`
                    <div class="alert alert-danger">
                        Une erreur est survenue lors du filtrage. Veuillez réessayer.
                    </div>
                `);
                console.error(xhr.responseText);
            }
        });
    });
    
  
      // Script pour gérer la réinitialisation des filtres
    document.querySelectorAll('.reset-price-filter').forEach(button => {
        button.addEventListener('click', function() {
            // Réinitialiser les champs de formulaire
            document.querySelectorAll('#priceFilterForm input').forEach(input => {
                input.value = '';
            });
            
            // Soumettre le formulaire pour rafraîchir les résultats
            document.getElementById('priceFilterForm').dispatchEvent(new Event('submit'));
        });
    });
});
</script>
@endsection
