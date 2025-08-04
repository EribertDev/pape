@extends('clients.master-1')
@section('extra-style')
    <!-- MAGNIFIC CSS -->
    <link rel="stylesheet" href="{{asset('clients/assets/css/niceselect.css')}}" />
    <link rel="stylesheet" href="{{asset(('clients/assets/css/shop.css'))}}" />
    <link rel="stylesheet" href="{{asset(('clients/assets/css/styles_perso.css'))}}" />
    <link rel="stylesheet" href="{{asset('clients/js-simple-loader-main/loader.css')}}" />
    <script  src="{{asset('clients/js-simple-loader-main/loader.js')}}"  ></script>
    <style>
      
        :root {
            --primary: #4f46e5;
            --secondary: #10b981;
            --dark: #1e293b;
            --light: #f8fafc;
            --gray: #64748b;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            color: var(--dark);
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        h1, h2, h3 {
            font-weight: 700;
            line-height: 1.2;
            margin-top: 0;
        }
        
        h1 {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }
        
        h1:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 80px;
            height: 4px;
            background: var(--secondary);
            border-radius: 2px;
        }
        
        h2 {
            font-size: 1.8rem;
            color: var(--primary);
            margin: 2.5rem 0 1rem;
        }
        
        h3 {
            font-size: 1.4rem;
            color: var(--dark);
            margin: 1.5rem 0 0.5rem;
        }
        
        p {
            font-size: 1.1rem;
            color: var(--gray);
            margin-bottom: 1.5rem;
        }
        
        .highlight {
            background-color: rgba(79, 70, 229, 0.1);
            border-left: 4px solid var(--primary);
            padding: 1.5rem;
            margin: 2rem 0;
            border-radius: 0 8px 8px 0;
        }
        
        ul.features {
            list-style: none;
            padding: 0;
            margin: 2rem 0;
        }
        
        ul.features li {
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="%2310b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>') no-repeat left center;
            padding-left: 32px;
            margin-bottom: 1rem;
            font-size: 1.1rem;
            color: var(--dark);
        }
        
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }
        
        .card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .card h3 {
            color: var(--primary);
        }
        
        .card-icon {
            background-color: rgba(79, 70, 229, 0.1);
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }
        
        .card-icon svg {
            width: 30px;
            height: 30px;
            color: var(--primary);
        }
        
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }
            
            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
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
                    <div class="ab_img text-center">
                        <img src="{{"clients/assets/images/icon/logo-syrram.png"}}" class="img-fluid" alt="image" style="height: 250px;width: 250px">
                    </div>
                </div><!--- END COL -->
                <div class="container">
        <h1>La plateforme PAPE</h1>
        <p class="highlight">
            <strong>La première plateforme tout-en-un</strong> pour réussir vos travaux académiques et projets professionnels
        </p>
        
        <p>
            La plateforme innovante PAPE est un espace numérique complet dédié à l'accompagnement académique et professionnel des étudiants, chercheurs et porteurs de projets. Elle réunit en un seul outil tous les services essentiels pour votre réussite.
        </p>
        
        <h2>Nos services intégrés</h2>
        
        <div class="grid">
            <div class="card">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3>Stages académiques</h3>
                <p>Trouvez directement votre stage depuis chez vous sans vous déplacer dans une administration.</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3>Rédaction collaborative</h3>
                <p>Éditeur en ligne pour mémoires, thèses et rapports avec travail simultané.</p>
            </div>
            
            <div class="card">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3>Visioconférence</h3>
                <p>Séances interactives intégrées avec partage d'écran et chat en direct.</p>
            </div>
        </div>
        
        <h2>Éditeur collaboratif</h2>
        
        <p>
            Grâce à l'éditeur intégré à la plateforme, plusieurs utilisateurs peuvent travailler simultanément sur un même document avec des fonctionnalités avancées :
        </p>
        
        <ul class="features">
            <li><strong>Édition en temps réel :</strong> chaque modification est visible instantanément par tous les participants</li>
            <li><strong>Annotations et commentaires :</strong> pour un suivi précis et ciblé des corrections</li>
            <li><strong>Historique des versions :</strong> pour revenir facilement à un état précédent du document</li>
            <li><strong>Exportation multiple :</strong> générez vos documents aux formats PDF ou Word en un clic</li>
        </ul>
        
        <h2>Visioconférence intégrée</h2>
        
        <p>
            Organisez des séances en ligne interactives directement au sein de la plateforme :
        </p>
        
        <div class="grid">
            <div class="card">
                <h3>Partage d'écran et vidéo</h3>
                <p>Travaillez côte à côte avec votre encadrant sans quitter l'éditeur.</p>
            </div>
            
            <div class="card">
                <h3>Chat en direct</h3>
                <p>Échangez rapidement des liens, données ou instructions pendant vos sessions.</p>
            </div>
            
            <div class="card">
                <h3>Planification intelligente</h3>
                <p>Organisez vos rendez-vous avec rappels automatiques.</p>
            </div>
        </div>
        
        <h2>Services complémentaires</h2>
        
        <p>
            PAPE offre également des services professionnels pour compléter votre expérience :
        </p>
        
        <ul class="features">
            <li><strong>Reprographie en ligne :</strong> reproduction et livraison confidentielle de vos documents avec tarif spécial étudiant</li>
            <li><strong>Formation continue :</strong> modules pratiques pour acquérir des compétences professionnelles</li>
            <li><strong>Bases de données :</strong> accès à des ressources documentaires spécialisées</li>
            <li><strong>Gestion centralisée :</strong> tous vos documents académiques sécurisés en un seul endroit</li>
        </ul>
        
        <div class="highlight">
            <h3>Accessibilité et sécurité</h3>
            <p>
                Notre solution est accessible depuis ordinateur ou smartphone, avec un espace de travail sécurisé hébergé sur des serveurs fiables, garantissant la confidentialité et l'intégrité de vos données.
            </p>
            <p>
                <strong>PAPE devient votre bureau virtuel</strong> pour la rédaction, la correction et l'accompagnement en direct, supprimant les barrières géographiques et accélérant votre processus de production académique et professionnelle.
            </p>
        </div>
    </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection
