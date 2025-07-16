@extends('clients.master-1')
@section('extra-style')
    <link rel="stylesheet" href="{{asset('clients/assets/css/niceselect.css')}}"/>
    <link rel="stylesheet" href="{{asset(('clients/assets/css/shop.css'))}}"/>
    <link rel="stylesheet" href="{{asset(('clients/assets/css/styles_perso.css'))}}"/>
    <link rel="stylesheet" href="{{asset(('clients/assets/css/profile.css'))}}"/>
    <link rel="stylesheet" href="{{asset(('clients/assets/css/btn-groupe.css'))}}"/>
    <link rel="stylesheet" href="{{asset(('stdev/css/badge-status.css'))}}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                  <button type="button" class="active"><a href="{{route('dash.client')}}" style="color: #FFF">Mes commandes</a></button>
                  {{-- <button type="button"> <a href="{{route('dash.client')}}"
                                            style="color: #1a2d62">Mes achats</a></button> --}}
                  <button type="button"> <a href="{{route('client.profile')}}"
                                            style="color: #1a2d62">Profile</a></button>
                </span>
                <div class="sidebar-post d-none d-lg-block">
                    <div class="sidebar_title"><h4>Tableau de Bord</h4></div>
                    <div class="sidebar-banner">
                        <a class="profil-link-active" href="{{route('dash.client')}}">Mes commandes</a>
                        {{-- <hr>
                        <a class="profil-link" href="#">Mes achats</a> --}}
                        <hr>
                        <a class="profil-link" href="{{route('internships.dash')}}"> Mes stages</a>
                        <hr>
                        <a class="profil-link" href="{{route('client.profile')}}">Profile</a>
                    </div><!-- END SOCIAL MEDIA POST -->
                </div>
                <!-- END SIDEBAR POST -->
            </div><!--- END COL -->
            <div class="col-lg-9 col-sm-12 col-xs-12">

                <div class="shopping-cart section">
                    <div class="container">
                        <div class="text-end">
                            <div class="cp_btn mb-4">
                                <a href="{{route('service.redaction')}}" class="cta"><span>Commander maintenant</span>
                                    <svg width="13px" height="10px" viewBox="0 0 13 10">
                                        <path d="M1,5 L11,5"></path>
                                        <polyline points="8 1 12 5 8 9"></polyline>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 table-responsive">
                            <!-- Shopping Summery -->
                            @if($commandes)
                                <table class="table shopping-summery" id="dataTable">
                                    <thead>
                                    <tr class="main-hading">
                                        <th>COMMANDE</th>
                                        <th>DESCRIPTION</th>
                                        <th class="text-center">STATUS</th>
                                        <th class="text-center">ACTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($commandes as $commande)
                                        @php
                                            $badge ='badge-'.$commande->status_name;
                                            $badge = strtolower($badge);
                                            $badge = str_replace(array(' ', 'é'), array('-', 'e'), $badge);
                                        @endphp
                                        <tr>
                                            <td class="image" data-title="No"><img
                                                    src="{{asset('clients/assets/images/shop/cart1.jpg')}}" alt="#">
                                            </td>
                                            <td class="product-des" data-title="Description">
                                                <p class="product-name"><a
                                                        href="#">{{ Str::limit($commande->subject,60)}}</a></p>
                                                <p class="product-des">{{ Str::limit($commande->description , 60)}}</p>
                                            </td>
                                            <td class="price" data-title="Price"><span
                                                    class="badge {{$badge}}">{{ $commande->status_name }}</span></td>
                                            <td class="action">
                                                <span>
                                                    
                                                @if ($commande->status_name ==="Traiter")
                                                    <a  class="download" data-uuid={{$commande->uuid}}><i
                                                        class="ti-download  mx-2"></i>
                                                    </a>
                                                @endif
                                                <a href="{{route('dash.client.commande.detail',['uuid' => $commande->uuid])}}"><i
                                                        class="ti-eye  mx-2"></i>
                                                </a>
                                               <a href="#"><i
                                                        class="ti-trash remove-icon  mx-2"></i>
                                               </a>
                                            </span>
                                            </td>
                                        
                                    @endforeach

                                    </tbody>
                                </table>
                                <div>
                                    {{ $commandes->links('pagination::bootstrap-5') }}
                                </div>
                            @endif
                            <!--/ End Shopping Summery -->
                        </div>
                    </div>
                </div>
            </div><!-- END COL-->

        </div><!-- END ROW-->
    </div>
@endsection

@section('extra-scripts')
    
    <script src="{{asset('clients/assets/js/nicesellect.js?'.Str::uuid())}}"></script>
    <script type="module" src="{{asset('clients/js-data/dash.js?'.Str::uuid())}}">
    <script type="text/javascript">
        $('select').niceSelect();
    </script>
    
@endsection
