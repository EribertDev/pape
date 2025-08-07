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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
            padding: 0;
            margin: 0;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
background: linear-gradient(135deg, #2c9e6a 0%, #1f5d4b 100%);
            color: white;
            padding: 60px 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
            background-size: cover;
        }
        
        h1 {
            font-size: 2.8rem;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }
        
        .header-subtitle {
            font-size: 1.4rem;
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        
        .ab_content {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 40px;
            margin: -40px auto 40px;
            position: relative;
            z-index: 10;
            max-width: 1000px;
        }
        
        h2 {
            color: #0d4a9e;
            font-size: 2.2rem;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #1a6dcc;
            position: relative;
        }
        
        h2 u {
            text-decoration: none;
            position: relative;
        }
        
        h2 u span {
            position: relative;
            z-index: 1;
        }
        
        h2 u::after {
            content: "";
            position: absolute;
            bottom: 5px;
            left: 0;
            width: 100%;
            height: 10px;
            background: rgba(26, 109, 204, 0.2);
            z-index: 0;
        }
        
        p {
            margin-bottom: 20px;
            font-size: 1.1rem;
            text-align: justify;
        }
        
        .highlight {
            background-color: rgba(26, 109, 204, 0.05);
            border-left: 4px solid #1a6dcc;
            padding: 20px;
            margin: 30px 0;
            border-radius: 0 8px 8px 0;
        }
        
        .features-list {
            margin: 25px 0 30px;
            padding-left: 20px;
        }
        
        .features-list li {
            margin-bottom: 15px;
            position: relative;
            padding-left: 30px;
        }
        
        .features-list li:before {
            content: "•";
            color: #1a6dcc;
            font-size: 24px;
            position: absolute;
            left: 0;
            top: -5px;
        }
        
        .features-list strong {
            color: #0d4a9e;
            display: block;
            margin-bottom: 5px;
        }
        
        .conclusion {
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
            padding: 30px;
            border-radius: 8px;
            margin-top: 30px;
            border-left: 4px solid #1a6dcc;
        }
        
        footer {
            background: #0d4a9e;
            color: white;
            text-align: center;
            padding: 30px 20px;
            margin-top: 40px;
        }
        
        @media (max-width: 768px) {
            header {
                padding: 40px 15px;
            }
            
            h1 {
                font-size: 2.2rem;
            }
            
            .header-subtitle {
                font-size: 1.1rem;
            }
            
            .ab_content {
                padding: 25px 20px;
                margin: -30px auto 30px;
            }
            
            h2 {
                font-size: 1.8rem;
            }
        }
    </style>
@endsection

@section('page-content')
    <section class="section-top">
        <div class="container">
            <div class="col-lg-10 offset-lg-1 text-center">
                <div class="section-top-title wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0" style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInRight;">
                    <h1>Comprendre le PAPE</h1>
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

             </div>
            <div class="ab_content">
              <header class="mb-4">
                <div class="container">
                   
                   <h1>La première plateforme tout-en-un pour réussir vos travaux académiques et projets professionnels</h1>
                </div>
            </header>
            
            <p>
                La plateforme innovante PAPE est un espace numérique complet dédié à l'accompagnement académique et professionnel des étudiants, chercheurs et porteurs de projets. Elle réunit en un seul outil : la recherche de stage académique, la rédaction collaborative en ligne des mémoires, thèses et projets, la visioconférence interactive, la gestion centralisée des documents, l'acquisition de base de données, la formation continue post universitaire et un service de reprographie en ligne avec livraison à domicile.
            </p>
            
            <div class="highlight">
                <p>
                    Le module de stage académique de la plateforme permet à l'étudiant de trouver directement son stage académique depuis sa position sans se déplacer dans une administration.
                </p>
            </div>
            
            <h3>Éditeur collaboratif</h3>
            
            <p>
                Grâce à l'éditeur collaboratif intégré à la plateforme, plusieurs utilisateurs peuvent travailler simultanément sur un même document de mémoire, thèse, rapport de stage ou projet professionnel avec :
            </p>
            
            <ul class="features-list">
                <li>
                    <strong>Édition en temps réel :</strong> chaque modification est visible instantanément par tous les participants
                </li>
                <li>
                    <strong>Annotations et commentaires :</strong> pour un suivi précis et ciblé des corrections
                </li>
                <li>
                    <strong>Historique des versions :</strong> pour revenir facilement à un état précédent du document
                </li>
                <li>
                    <strong>Exportation au format PDF ou Word</strong>
                </li>
            </ul>
            
            <h3>Visioconférence intégrée</h3>
            
            <p>
                L'intégration du module de visioconférence permet d'organiser des séances en ligne interactives directement au sein de la plateforme avec :
            </p>
            
            <ul class="features-list">
                <li>
                    <strong>Partage d'écran et vidéo :</strong> l'étudiant et l'assistant travaillent côte à côte, sans quitter l'éditeur.
                </li>
                <li>
                    <strong>Chat en direct :</strong> pour échanger rapidement des liens, données ou instructions.
                </li>
                <li>
                    <strong>Planification et notifications :</strong> organisation des rendez-vous et rappels automatiques.
                </li>
            </ul>
            
            <p>
                La plateforme offre aussi un service professionnel de reprographie avec livraison à l'appui pour reproduire et livrer en toute confidentialité les documents de mémoires, thèses, rapports de stage ou tout autre document avec un tarif spécial étudiant.
            </p>
            
            <p>
                Un service de formation vient couronner tous les services et permet aux étudiants d'avoir les outils pratiques indispensables à l'exécution de leurs professions.
            </p>
            
            <p>
                Chacune des offres de service est accessible sur la plateforme grâce à un bouton dédié.
            </p>
            
            <div class="conclusion">
                <p>
                    Notre solution est accessible depuis un ordinateur ou un smartphone, avec un espace de travail sécurisé, hébergé sur des serveurs fiables, garantissant la confidentialité et l'intégrité des données.
                </p>
                
                <p>
                    En résumé, notre plateforme devient un véritable bureau virtuel pour la rédaction, la correction et l'accompagnement en direct, supprimant la barrière entre l'étudiant et son encadrant, et accélérant le processus de production de documents académiques et professionnels.
                </p>
            </div>
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
