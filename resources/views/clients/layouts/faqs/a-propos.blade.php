@extends('clients.master-1')
@section('extra-style')
    <!-- MAGNIFIC CSS -->
    <link rel="stylesheet" href="{{asset('clients/assets/css/niceselect.css')}}" />
    <link rel="stylesheet" href="{{asset(('clients/assets/css/shop.css'))}}" />
    <link rel="stylesheet" href="{{asset(('clients/assets/css/styles_perso.css'))}}" />
    <link rel="stylesheet" href="{{asset('clients/js-simple-loader-main/loader.css')}}" />
    <script  src="{{asset('clients/js-simple-loader-main/loader.js')}}"  ></script>
    <style>
        .text-justify{
            text-align: justify;
        }
    </style>
@endsection

@section('page-content')
    <section class="section-top">
        <div class="container">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0" style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInRight;">
                    <h1>A propos</h1>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>
    <section class="ab_one section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp mt-5 mb-5" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <div class="ab_img">
                        <img src="{{"clients/assets/images/icon/logo-syrram.png"}}" class="img-fluid" alt="image">
                    </div>
                </div><!--- END COL -->
                <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0" style="visibility: visible; animation-duration: 1s; animation-delay: 0.1s; animation-name: fadeInUp;">
                    <div class="ab_content">
                        <h2 class="mb-2 fs-2">A propos de <u><span>SyRRaM</span></u></h2>
                        <p class="text-justify">
                            <strong>SyRRaM</strong>, un service du cabinet <strong>CESIE BENIN</strong>, est un système innovant conçu pour accompagner les étudiants et chercheurs dans la rédaction de mémoires et thèses. Grâce à un ensemble d'outils digitaux, SyRRaM offre un appui technique tout au long du processus de rédaction, garantissant une qualité optimale et le respect des normes universitaires.
                        </p>
                        <p class="text-justify">
                            Notre mission est de rendre la rédaction académique plus rapide, efficace, et accessible à tous, en proposant un encadrement personnalisé à chaque étape, depuis la revue documentaire jusqu’à l’analyse des données.
                        </p>

                        <p class="text-justify">
                            Que vous soyez étudiant, chercheur débutant ou confirmé, SyRRaM vous guide pour produire un travail rigoureux et conforme aux exigences académiques.
                        </p>

                        <p class="text-justify">
                            En plus de l’accompagnement à la rédaction, SyRRaM propose des services spécifiques tels que l’analyse de données, la mise en forme, et la vente de bases de données issues de collectes réalisées dans différents domaines de recherche.
                        </p>

                        <p class="text-justify">
                            Notre équipe, réactive et disponible, est dédiée à vous fournir un soutien complet pour vos projets académiques.
                        </p>
                        <p class="text-justify">
                            Avec SyRRaM, vous avez la garantie d’un travail de qualité, livré dans les délais, tout en assurant la confidentialité de vos données et de vos travaux.
                        </p>
                    </div>
                </div><!--- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <section class="faq_area section-padding">
        <div class="container">
            <div class="section-title">
                <p>Questions <span><u>Générales</u></span></p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Qu'est-ce que SyRRaM ?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    SyRRaM est un service du cabinet Cesie Bénin qui accompagne les étudiants et chercheurs dans la rédaction rapide et efficace de mémoires et thèses en utilisant des outils digitaux innovants.
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    En quoi SyRRaM est-il différent des autres services de rédaction ?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    SyRRaM se distingue par son approche digitale qui guide l’utilisateur à chaque étape de la rédaction, tout en garantissant la qualité académique et la conformité aux normes universitaires.
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Qui peut bénéficier des services de SyRRaM ?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    SyRRaM est destiné aux étudiants, chercheurs débutants ou confirmés, qui ont besoin d’assistance pour la rédaction de mémoires, thèses ou autres travaux académiques.
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    SyRRaM est-il un service local ou international ?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Bien que SyRRaM soit basé au Bénin à travers le cabinet Cesie, ses services sont accessibles à tous, quel que soit le pays, grâce à ses outils digitaux.

                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                    Quelles sont les valeurs qui guident SyRRaM ?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    SyRRaM valorise l’efficacité, la qualité, la confidentialité et l’accompagnement personnalisé pour permettre à chaque étudiant et chercheur de produire un travail académique rigoureux.
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                    </div>
                </div><!-- END COL  -->
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <div class="pt_faq">
                        <img src="{{asset('clients/assets/images/all-img/faq.png')}}" class="img-fluid" alt="image">
                    </div>
                </div><!-- END COL  -->
            </div><!--END  ROW  -->
        </div><!--- END CONTAINER -->
    </section>

@endsection

@section('extra-scripts')

@endsection
