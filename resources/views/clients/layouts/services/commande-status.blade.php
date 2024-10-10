@extends('clients.master-1')
@section('extra-style')

@endsection

@section('page-content')
    <!-- Start Breadcrumbs -->
    <section class="section-top">
        <div class="container">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0" style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInRight;">
                    <h1>Vérifier le statut d'une commande</h1>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- End Breadcrumbs -->

    <!-- START NEWSLETTER -->
    <section class="newsletter_area section-padding">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-6 offset-lg-3 col-sm-12 col-xs-12">
                    <div class="subs_form">
                        <h3>Veuillez renseigner le numéro de votre reçu de paiement </h3>
                        <form action="#" class="home_subs">
                            <input type="text" class="subscribe__input" placeholder="Ex: CD_87RT8YY9">
                            <button type="button" class="subscribe__btn"><i class="fa fa-paper-plane-o"></i></button>
                        </form>
                    </div>
                </div><!-- END COL -->
            </div><!-- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END NEWSLETTER -->


@endsection

@section('extra-scripts')

    <script>

    </script>

@endsection
