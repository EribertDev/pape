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
                    <h1>FAQ's</h1>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>
    <section class="faq_area section-padding">
        <div class="container">
            <div class="section-title-two">
                <h2>FAQ – PAPE 📝</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Qu’est-ce que le PAPE ?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Le PAPE est un Programme d’accompagnement Professionnel des étudiants avec pour objectifs de :
                                    <ul>
                                        <li>👉 Rechercher une administration d’accueil (publique ou privée) à l'étudiant dans le cadre de son stage éducatif.</li>
                                        <li>👉 Coacher l'étudiant ou le chercheur dans la rédaction de son mémoire ou thèse.</li>
                                        <li>👉 Coacher l'étudiant ou le chercheur dans la collecte et l’analyse des données de terrain.</li>
                                        <li>👉 Former l'étudiant ou le chercheur à la conduite des vielen de recherche.</li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Quels sont les services offerts par le PAPE ?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Le PAPE offre au-delà des formations et de l’opportunité gratuite de stage, un coaching en :
                                    <ul>
                                        <li>👉 Rédaction complète du mémoire ou de la thèse</li>
                                        <li>👉 Protocole de recherche</li>
                                        <li>👉 Analyse des données</li>
                                        <li>👉 Mise en forme du document</li>
                                        <li>👉 Commande et livraison rapide du mémoire ou de la thèse</li>
                                        <li>👉 Vente de bases de données issues des collectes de donnée</li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        À qui s'adresse le PAPE ?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Le programme est destiné aux :
                                    <ul>
                                        <li>👉 Etudiants ou chercheurs</li>
                                        <li>👉 Particuliers</li>
                                        <li>👉 Administrations</li>
                                        <li>👉 Ou tout autre personne désireuse d’avoir des aptitudes en conduite d’études ou recherches</li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour" aria-expanded="false"
                                        aria-controls="collapseFour">
                                        Comment puis-je bénéficier du PAPE ?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    En exprimant ses requêtes via la plateforme du programme
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFive" aria-expanded="true"
                                        aria-controls="collapseFive">
                                        Le PAPE prend-il en compte l’analyse des données ?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Absolument. Le PAPE fournit une assistance complète pour la collecte, l’analyse rapide et fiable des données conformément aux orientations du travail et aux normes universitaires. 
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSix" aria-expanded="true"
                                        aria-controls="collapseSix">
                                        En combien de temps, l’étudiant arrive-t-il à rédiger son mémoire ou sa thèse avec le PAPE ?
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    En Cinq (05) séances de coaching au maximum
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFive" aria-expanded="true"
                                        aria-controls="collapseFive">
                                        Comment puis-je suivre le traitement de mes requêtes sur le PAPE ?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    En ligne via la présente plateforme dédiée au programme
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        
                    </div>
                </div><!-- END COL  -->
            </div><!--END  ROW  -->
        </div><!--- END CONTAINER -->
    </section>
@endsection

@section('extra-scripts')

@endsection
