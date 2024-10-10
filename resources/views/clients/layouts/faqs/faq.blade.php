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
                <h2>FAQ – SyRRaM 📝</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Qu’est-ce que le SyRRaM ?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    SyRRaM est un système digital conçu pour encadrer les étudiants et chercheurs dans la rédaction de mémoires et thèses. Il offre un appui technique tout au long du processus de rédaction, depuis la revue documentaire jusqu’à l’analyse des données. Le système permet une rédaction rapide, efficace et conforme aux normes universitaires. 🚀📚
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Quels sont les services offerts par SyRRaM ?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    SyRRaM propose une large gamme de services pour la rédaction de mémoires et de thèses, notamment :
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
                                    À qui s'adresse SyRRaM ?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    SyRRaM est destiné aux étudiants et chercheurs qui travaillent sur des mémoires, des thèses ou tout autre travail de recherche. Il convient aussi bien aux débutants qu’aux chercheurs confirmés qui cherchent à optimiser leur temps et la qualité de leur rédaction. 🎓📖
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour" aria-expanded="false"
                                        aria-controls="collapseFour">
                                    Comment puis-je commander un mémoire ou une thèse via SyRRaM ?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Vous pouvez passer commande directement sur la plateforme. Après avoir spécifié vos besoins et les informations nécessaires, le système s’occupe de rédiger le mémoire ou la thèse et vous le livre dans un délai record. 🛒⏱️
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFive" aria-expanded="true"
                                        aria-controls="collapseFive">
                                    SyRRaM prend-il en charge l’analyse des données ?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Absolument. Le système inclut des outils et un accompagnement pour l'analyse des données. Vous pouvez soumettre vos données et recevoir une analyse complète qui répond aux exigences de votre recherche. 📈🔍
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSix" aria-expanded="true"
                                        aria-controls="collapseSix">
                                    Combien de temps prend la rédaction d’un mémoire ou d’une thèse avec SyRRaM ?
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Le temps dépend du type de service commandé et de la complexité de la recherche. Cependant, SyRRaM est conçu pour accélérer chaque étape du processus, garantissant une rédaction en un temps record. ⏳🚀
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFive" aria-expanded="true"
                                        aria-controls="collapseFive">
                                    Comment puis-je suivre l'avancement de mon mémoire ou de ma thèse ?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    SyRRaM vous permet de suivre en temps réel l’avancement de votre projet. Vous serez informé des différentes étapes franchies et recevrez des mises à jour régulières sur l’état d’avancement de la rédaction. 🔄📱
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFive" aria-expanded="true"
                                        aria-controls="collapseFive">
                                    Est-ce que SyRRaM garantit le respect des normes universitaires ?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Oui, SyRRaM garantit que les mémoires et thèses produits respectent strictement les normes universitaires en vigueur, tant sur le fond que sur la forme. ✅🎓
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
