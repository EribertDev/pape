@extends('clients.master-1')
@section('extra-style')
    <!-- MAGNIFIC CSS -->
    <link rel="stylesheet" href="{{asset('clients/assets/css/niceselect.css')}}" />
    <link rel="stylesheet" href="{{asset(('clients/assets/css/shop.css'))}}" />
    <link rel="stylesheet" href="{{asset(('clients/assets/css/styles_perso.css'))}}" />
    <link rel="stylesheet" href="{{asset('clients/js-simple-loader-main/loader.css')}}" />
    <script  src="{{asset('clients/js-simple-loader-main/loader.js')}}"  ></script>
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
                <div class="home_sb mb-5">
                    <form action="#" class="banner_subs">
                        <input type="text" class="form-control home_si" placeholder="Recherche..." required="required">
                       {{-- <button type="button" class="subscribe__btn">Search <i class="fa fa-paper-plane-o"></i></button>--}}
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
                                    <div class="product_item" id="MixItUp9ABD8C">
                                        <div class="row">
                                            @foreach($bds as $db)
                                                <div class="col-lg-3 col-md-4 col-sm-6 mix" style="display: inline-block;" data-bound="" >
                                                    <div class="product-grid border border-0 rounded-3 shadow-lg" >
                                                        <div class="product-image">
                                                            <a href="#">
                                                                <img class="pic-1" src="{{asset('clients/assets/images/shop/5.jpg')}}"
                                                                     alt="product image">
                                                                <img class="pic-2" src="{{asset('clients/assets/images/shop/6.jpg')}}"
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
                                                            <div class="price">{{$db->amount}} F cfa
                                                            </div>
                                                            <div >
                                                                <a class="payer-link fw-bold commande-bd" data-uuid-bd = "{{$db->uuid}}" style="">Commander</a>
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
    <script></script>
@endsection
