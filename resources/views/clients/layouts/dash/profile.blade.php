@extends('clients.master-1')
@section('extra-style')
    <link rel="stylesheet" href="{{asset('clients/assets/css/niceselect.css')}}" />
    <link rel="stylesheet" href="{{asset(('clients/assets/css/shop.css'))}}" />
    <link rel="stylesheet" href="{{asset(('clients/assets/css/profile.css'))}}" />
    <link rel="stylesheet" href="{{asset(('clients/assets/css/btn-groupe.css'))}}" />
         <script src="https://cdn.tailwindcss.com"></script>

@endsection

@section('page-content')
 <div class="mobile-nav fixed bottom-0 left-0 right-0 bg-white shadow-lg z-50 md:hidden">
        <div class="flex justify-around py-3">
            <a href="{{route('dash.client')}}" class="text-primary flex flex-col items-center" style="margin-right: 30px;">
                <i class="fas fa-home text-lg mb-1"></i>
                <span class="text-xs">Accueil</span>
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
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0" style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInRight;">
                    <h1>Mon espace Client</h1>
                     <ul>
                         <li class="fw-bold">Profile</li>
                     </ul>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>

    <div class="container-fluid" style="background-color: #f6f6f6">
        <div class="row">
            <div class="col-lg-3 col-sm-12 col-xs-12 mt-5 pt-2 ">
                <div class="container"><h2 class="fw-bold">Salut👋</h2><h2 class="fw-bold mb-1"> {{ session('clientInfo') ->fist_name}}</h2></div>
                <span class="button-groups-1 d-flex justify-content-center d-block d-lg-none ">
                  <button type="button" ><a href="{{route('dash.client')}}" style="color: #1a2d62">Mes commandes</a></button>
                   <button type="button">
                                        <a class="profil-link" href="{{route('internships.dash')}}">Mes Stages</a>
                                </button>
                   <button type="button">
                                        <a class="profil-link" href="{{route('projects.dash')}}">Projets</a>
                    </button>
                  {{-- <button type="button"> <a  href="{{route('dash.client')}}" style="color: #1a2d62">Mes achats</a></button> --}}
                  <button type="button" class="active"> <a  href="{{route('client.profile')}}" style="color: #FFF">Profile</a></button>
                </span>
                <div class="sidebar-post d-none d-lg-block">
                    <div class="sidebar_title"><h4>Tableau de Bord</h4></div>
                    <div class="sidebar-banner">
                        <a class="profil-link" href="{{route('dash.client')}}">Mes commandes</a>
                        {{-- <hr>
                        <a class="profil-link" href="#">Mes achats</a> --}}
                        <hr>
                        <a class="profil-link-active" href="{{route('client.profile')}}" >Profile</a>
                    </div><!-- END SOCIAL MEDIA POST -->
                </div><!-- END SIDEBAR POST -->
            </div><!--- END COL -->
            <div class="col-lg-9 col-sm-12 col-xs-12">
                <div class="shopping-cart section">
                    <div class="container">
                        <div class="row mb-3">
                            {{--<div class="col-12">
                                <!-- Total Amount -->
                                <div class="total-amount">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-5 col-12">
                                            <div class="left">
                                                <div class="coupon">
                                                    <form action="#" target="_blank">
                                                        <input name="Coupon" placeholder="Enter Your Coupon">
                                                        <button class="btn">Apply</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Total Amount -->
                            </div>--}}
                        </div>
                        <div class="col-12">
                            <!-- Shopping Summery -->
                            <div class="single_agent">
                                <div class="single_agent_content">
                                    <h4>{{ session('clientInfo') ->fist_name .' '. session('clientInfo') ->last_name}}</h4>
                                    <h5>Client</h5>
                                    {{-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever type book.</p> --}}
                                    <form id="infoForm">
                                        @csrf
                                       <div class="row">
                                           <div class="form-group col-12 col-md-6">
                                               <label for="last_name">Nom</label>
                                               <input type="text" id="last_name" class=" form-control requiredField input-label" name="last_name" value="{{session('clientInfo') ->last_name }}">
                                           </div>
                                           <div class="form-group col-12 col-md-6">
                                               <label for="fist_name">Prénoms</label>
                                               <input type="text" id="fist_name" class=" form-control requiredField input-label" name="fist_name" value="{{session('clientInfo') ->fist_name }}">
                                           </div>
                                       </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" class="form-control requiredField input-label" name="email" value="{{Auth::user()->email}}">
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label for="phone_number">Téléphone</label>
                                                <input type="tel" id="phone_number" class="form-control requiredField input-label" name="phone_number" value="{{session('clientInfo') ->phone_number }}">
                                            </div>
                                        </div>
                                       {{-- <div class="row">
                                            <div class="form-group col-12">
                                                <label for="password">Password</label>
                                                <input type="password" id="password" class="form-control requiredField input-label" name="password">
                                            </div>
                                            --}}{{-- <div class="form-group col-12 col-md-6">
                                                 <label for="confirmedPwd">Confirmer</label>
                                                 <input type="password" id="confirmedPwd" class="form-control requiredField input-label" name="confirmedPwd">
                                             </div>--}}{{--
                                        </div>--}}
                                        <div class="form-group col-lg-12 mt-4">
                                            <button class="btn_one border-0" type="button"  id="editBtn">
                                                <span role="status">Modifier</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--/ End Shopping Summery -->
                        </div>
                    </div>
                </div>
            </div><!-- END COL-->

        </div><!-- END ROW-->
    </div>
@endsection

@section('extra-scripts')

    <div class="modal fade" id="comfimeEditModale" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fw-bolder">Confirmation de modification </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="fs-5 fw-bolder"> Être vous de vouloir enregistrer les modifications?</p>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn_one btn btn-secondary border-0 rounded-5" data-bs-dismiss="modal" >Non</button>
                    <button type="button" class="btn_one border-0" id="yesBtn">Oui</button>
                </div>
            </div>
        </div>
    </div>



    <script src="{{asset('clients/assets/js/nicesellect.js')}}"></script>
    <script type="text/javascript">
        $('select').niceSelect();
    </script>
    <script type="module" src="{{asset('clients/js-data/profile.js')}}" ></script>
@endsection
