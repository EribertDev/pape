@extends('clients.master-1')

@section('extra-style')
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{asset('client/js-simple-loader-main/loader.css')}}" />
    <script  src="{{asset('client/js-simple-loader-main/loader.js')}}"  ></script>
    <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />

@endsection

@section('page-content')
    <!-- Start Breadcrumbs -->
    {{-- <section class="section-top">
        <div class="container">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0" style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInRight;">
                    <h1>Succès</h1>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section> --}}
    <!-- End Breadcrumbs -->

    <section class="zero_area section-padding">
        <div class="container">
            <div class="row pt-5 mt-sm-5">
                <div class="col-lg-12 col-sm-12 col-xs-12 text-center pt-5">
                    <div class="error_page">
                        <img src="{{asset("clients/assets/images/icon/valide.png")}}" class="img-fluid" alt="Sucees" style="height: 150px;height: 150px">
                        <h2>Succès</h2>
                        <h5>Votre adresse email a été validée avec succès ! Vous pouvez maintenant profiter de toutes nos fonctionnalités.</h5>
                        <div class="home_btn mt-3">
                            <a href="{{route("home")}}" class="btn_one">Accueil</a>
                        </div>
                    </div>
                </div><!--- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
@endsection

@section('extra-scripts')

   {{-- <div class="modal" id="modal-loading" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="loading-spinner mb-2"></div>
                    <div>Loading</div>
                </div>
            </div>
        </div>
    </div>--}}
@endsection