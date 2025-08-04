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
                        <h2 class="mb-2 fs-2">A propos de <u><span>PAPE  </span></u></h2>
                        <p class="text-justify">
                            PAPE, un service du cabinet CESIE BENIN,
                            est un programme innovant conçu pour faciliter la mise en stage académique des étudiants et chercheurs,
                            les assister  dans la rédaction de leurs mémoires et thèses. Ce programme, offre une insertion dans le milieu professionnel,
                            un appui technique tout au long du processus de rédaction de mémoire ou thèse,
                                garantissant une qualité optimale et le respect des normes universitaires.                       
                        </p>
                     
                        <p class="text-justify">
                            Que vous soyez étudiant, chercheur débutant ou confirmé, PAPE vous guide pour produire un travail rigoureux et conforme aux exigences académiques.
                        </p>

                        <p class="text-justify">
                            En plus de l’accompagnement à la rédaction, PAPE propose des services spécifiques tels que l’analyse de données, la mise en forme, et la vente de bases de données issues de collectes réalisées dans différents domaines de recherche.
                        </p>

                        <p class="text-justify">
                            A tout cela s'ajoute la possibilité pour l'étudiant de consulter des thématiques innovantes déjà formulées mais non encore utilisées qu'il peut choisir ou dont il peut s'inspirer pour formuler son sujet de recherche.
                        </p>

                        <p class="text-justify">
                            Le PAPE offre aussi un service d'assistance à la rédaction de projet et business plan pour accompagner toutes personnes (étudiant ou non) ou entités désireuses de s'engager dans l'entrepreneuriat.
                        </p>

                        <p class="text-justify">
                            Par-dessus tout, le PAPE offre aussi un service professionnel de reprographie avec livraison à l'appui pour reproduire et livrer en toute confidentialité des documents de toutes personnes désireuses.   
                         </p>

                         <p class="text-justify">
                            Un tarif spécial étudiant est directement appliqué par la plateforme pour permettre à aux étudiants d'imprimer à moindre coût leurs mémoires de fin de formation.
                         </p>

                         <p class="text-justify">
                            Enfin les particuliers, administrations et autres qui désirent bénéficier des mêmes services peuvent exprimer aussi leurs requêtes via cette même plateforme.                        
                         </p>
                         <p class="text-justify">
                            Chacune des offres de service est accessible sur la plateforme grâce à un bouton dédié.
                         </p>

                        <p class="text-justify">
                            Notre équipe, réactive et disponible, est dédiée à vous fournir un soutien complet pour vos projets académiques.

                        </p>
                        <p class="text-justify">
                            Avec PAPE, vous avez la garantie d’un travail de qualité, tout en assurant la confidentialité de vos données et de vos travaux.
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
                                    Qu’est-ce que le PAPE ?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Le PAPE est un Programme d’accompagnement Professionnel des Étudiants avec pour objectifs de :
                                    <ul>
                                        <li>👉 Rechercher une administration d’accueil (publique ou privée) à l’étudiant dans le cadre de son stage académique</li>
                                        <li>👉 Coacher l’étudiant ou le chercheur dans la rédaction de son mémoire ou thèse</li>
                                        <li>👉 Coacher l’étudiant ou le chercheur dans la collecte et l’analyse des données de terrain</li>
                                        <li>👉 Former l’étudiant ou le chercheur à la conduite des travaux de recherche</li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    En quoi le PAPE est-il différent des autres services de rédaction ?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Le PAPE est un programme didactique destiné à accompagner l’étudiant dans sa formation universitaire. Il ne se substitue pas à l’étudiant ou au chercheur dans le cadre de sa rédaction. De plus, le PAPE contribue à l’insertion de l’étudiant ou du chercheur dans une administration pour la réalisation de son stage.
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Qui peut bénéficier des services du PAPE ?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Le programme est destiné aux :
                                    <ul>
                                        <li>👉 Étudiants ou chercheurs</li>
                                        <li>👉 Particuliers</li>
                                        <li>👉 Administrations</li>
                                        <li>👉 Ou tout autre personne désireuse d’avoir des aptitudes en conduite d’études ou recherches</li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Le PAPE est-il un service local ou international ?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Le Programme est basé au Bénin avec la possibilité de servir aussi au-delà des frontières béninoises
                                </div>
                            </div>
                        </div><!-- END ACCORDION ITEM  -->
                    </div>
                </div><!-- END COL  -->
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <div class="pt_faq">
                        <img src="{{asset('clients/assets/images/all-img/dg-cesie.jpg')}}" class="img-fluid img-responsive col-lg-6 col-sm-6 col-xs-12 mt-2" alt="image" style="">
                        <img src="{{asset('clients/assets/images/all-img/syrram_hero.jpg')}}" class="img-fluid img-responsive col-lg-6 col-sm-6 col-xs-12 mt-2" alt="image" style="">
                        <img src="{{asset('clients/assets/images/all-img/equipe-cesie1.jpg')}}" class="img-fluid img-responsive col-lg-6 col-sm-6 col-xs-12 mt-2" alt="image" style="">
                        <img src="{{asset('clients/assets/images/all-img/equipe-cesie2.jpg')}}" class="img-fluid img-responsive col-lg-6 col-sm-6 col-xs-12 mt-2" alt="image" style="">
                        <img src="{{asset('clients/assets/images/all-img/equipe-cesie3.jpg')}}" class="img-fluid img-responsive col-lg-6 col-sm-6 col-xs-12 mt-2" alt="image" style="">


                    </div>
                </div><!-- END COL  -->
            </div><!--END  ROW  -->
        </div><!--- END CONTAINER -->
    </section>


@endsection

@section('extra-scripts')

@endsection
