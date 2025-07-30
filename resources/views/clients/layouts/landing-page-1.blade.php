@php use Illuminate\Support\Facades\Hash; @endphp
@extends('clients.master-1')
@section('extra-style')
    <link rel="stylesheet" href="{{asset('clients/assets/css/styles_perso.css')}}"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

     <style>
        .text-justify {
            text-align: justify;
        }
        
        /* Styles pour la nouvelle section d'accueil */
        .home-feature-section {
            display: flex;
            flex-wrap: wrap;
            margin: 50px 0;
        }
        
        .feature-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
            border-top: 4px solid #2eca7f;
            text-align: center;
            margin-right: 5px
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .feature-icon {
            font-size: 48px;
            color: #2eca7f;
            margin-bottom: 20px;
        }
        
        .feature-title {
            font-weight: 700;
            color: #1a2d62;
            margin-bottom: 15px;
            font-size: 1.3rem;
        }
        
        .feature-description {
            color: #555;
            margin-bottom: 25px;
            font-size: 0.95rem;
        }
        
        .feature-btn {
            background: #1a2d62;
            color: white;
            padding: 10px 25px;
            border-radius: 30px;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid #1a2d62;
        }
        
        .feature-btn:hover {
            background: transparent;
            color: #1a2d62;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .feature-card {
                margin-bottom: 20px;
            }
            
            .home_content h2 {
                font-size: 1.8rem;
                line-height: 2.2rem;
            }
        }
    </style>
@endsection

@section('page-content')
    <!-- START HOME -->
    @php
      //  $categories = $data["categories"];
       // $bd = $data["bd"];
    @endphp
    <section id="home" class="home_bg"
             style="background-image: url({{asset('clients/assets/images/banner/home.png')}});  background-size:cover; background-position: center center;">
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-6 col-sm-6 col-xs-12 ">
                    <div class="home_content d-block d-lg-none mt-3 pb-5 text-center">
                        <h2 class="fw-bold text-center"><span>Etudiant et Chercheur, bienvenue sur votre plateforme PAPE.  Faites défiler vers le bas pour découvrir nos services </h2>
                        <p class="mt-4  text-center"></p>
                       <div class="row">
                            @guest
                              <!---    <div class="col-lg-4 col-md-7 col-sm-8  justify-content-center">
                                    <div class="">
                                        <a class="btn_one" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Connexion</a>
                                    </div>
                                </div>-->
                                 
                            @endguest
                            @auth
                                 <!---  <div class="col-lg-7 col-md-3 col-sm-8 mb-7 d-flex justify-content-center">
                                    <div class="call_to_action">
                                        <a class="btn_one" type="button" href="{{route('redaction.offers')}}"> <span>Faire une commande </span></a>
                                    </div> 
                                </div>   -->
                        @endauth
                       </div>
                    </div>
                   <div class="home_content  d-none d-lg-block">
                        <h2 class="fw-bold "><span>Etudiant et Chercheur, bienvenue sur votre plateforme PAPE.  Faites défiler vers le bas pour découvrir nos services  </span></h2>
                        <p class="mt-3"></p>
                    
                        <div class="row">
                            @guest
                               <!--- <div class="col-lg-3 col-md-3 col-sm-8 ms-2 mb-4">
                                    <div class="call_to_action">
                                        <a class="btn_one" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Connexion</a>
                                    </div>  
                                    
                                </div> -->
                            @endguest

                             @auth
                                 <!--- <div class="col-lg-3 col-md-3 col-sm-4 ms-2 mb-4">
                                    <div class="call_to_action">
                                         <a class="btn_one" type="button" href="{{route('stage')}}"><span style="white-space: nowrap;">Demander Stage</span></a>
                                    </div> 
                                    
                                </div> -->
                            @endauth
                            
                            
                            <div class="col-lg-8 col-md-3 col-sm-4 mb-4">
                               <!--- <div class="call_to_action">
                                    @auth
                                        <a class="btn_one" type="button" href="{{route('redaction.offers')}}"> <span>Faire une commande</span></a>
                                    @endauth
                                    @guest
                                        <a class="btn_one" type="button" data-bs-toggle="modal" data-bs-target="#registerModal"> <span>Créer un compte</span></a>
                                    @endguest
                                </div>  -->
                            </div>
                        </div>
                        <div class="row">

                        </div>
                    </div>
                </div><!-- END COL-->
            <div class="col-lg-6 col-sm-6 col-xs-12 d-none d-lg-block">
                <div class="mt-5 pt-5">
                    <img src="{{asset('clients/assets/images/all-img/home-image.png')}}" class="img-fluid" alt=""/>
                </div>

            </div><!-- END COL-->

            
        </div>
    </section>
    <!-- END  HOME -->
    <section class="container">
         <div class="home-feature-section">
                <!-- Bouton 1: Faire une demande de stage -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h3 class="feature-title">Demande de Stage</h3>
                        <p class="feature-description">Trouvez le stage académique idéal adapté à votre domaine d'études et à vos aspirations professionnelles.</p>
                        <a 
                        href="{{ auth()->check() ? route('stage') : '#' }}" 
                        @if(!auth()->check()) 
                            data-bs-toggle="modal" 
                            data-bs-target="#loginModal"
                        @endif
                        
                        class="feature-btn">Faire une demande</a>
                    </div>
                    
                </div>
                
                <!-- Bouton 2: Commander mémoire/thèse -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h3 class="feature-title">Demander Assistance pour la rédaction de vos mémoire/Thèse</h3>
                        <p class="feature-description">Bénéficiez d'un accompagnement expert pour la rédaction de vos travaux académiques.</p>
                        <a href="{{ auth()->check() ? route('redaction.offers') : '#' }}" 
                        @if(!auth()->check()) 
                            data-bs-toggle="modal" 
                            data-bs-target="#loginModal"
                        @endif
                        
                        class="feature-btn">Commander</a>
                    </div>
                </div>
                
                <!-- Bouton 3: Bases de données -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <h3 class="feature-title">Bases de Données</h3>
                        <p class="feature-description">Accédez à notre vaste collection  de base de données (commercial) </p>
                        <a href="{{route('bds.all')}}" class="feature-btn">Explorer</a>
                    </div>
                </div>
                
                <!-- Bouton 4: Thèmes -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h3 class="feature-title">Thèmes de Recherche</h3>
                        <p class="feature-description">Découvrez des idées de sujets innovants pour vos travaux académiques.</p>
                        <a href="{{route('biblios')}}" class="feature-btn">Voir les thèmes</a>
                    </div>
                </div>
            </div>

             <!-- Nouvelle carte pour Demandes de Formation -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <div class="feature-card h-100">
            <div class="feature-icon bg-formation">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <h3 class="feature-title">Demande de Formation</h3>
            <p class="feature-description">Des formations de qualités qui facilitent votre insertion professionnelle</p>
               <button type="button" class="feature-btn" data-bs-toggle="modal" data-bs-target="#formationModal">
            <i class="fas fa-graduation-cap me-2"></i>Demander une formation
            </button>
              
            </a>
        </div>
         <div class="feature-card h-100">
                <div class="feature-icon bg-pape">
                    <i class="fas fa-users"></i> <!-- Icône équipe -->
                </div>
                <h3 class="feature-title">Contactez l'équipe</h3>
                <p class="feature-description">Une question ? Notre équipe PAPE vous répond</p>
                
                <a href='{{route('contact')}}' class="feature-btn contact-btn">
                    <i class="fas fa-paper-plane me-2"></i>Contacter par email
                </a>
        </div>

        

        
    </div>
            <!-- FIN DE LA NOUVELLE SECTION -->
    </section>
   
   {{-- 
   
     <!-- START TOP PROMO FEATURES -->
    <section class="tp_feature">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
                    <div class="single_tp">
                        <h3>Assistance dans la rédaction de vos mémoires et thèses</h3>
                        <p>
                            Faîtes-vous assister par le programme  PAPE pour rédiger vite, bien et sans plagiat vos mémoires de fin de formation
                        </p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                    <div class="single_tp">
                        <h3>Assistance pour la recherche de stage académique et professionnel</h3>
                        <p>Inscrivez-vous au programme PAPE pour bénéficier des opportunités gratuites de stage académique et professionnel.</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
                    <div class="single_tp">
                        <h3>Collecte et analyse de données pour vos recherches</h3>
                        <p>Le PAPE vous permet de vite réaliser vos collectes et analyses de données dans le cadre de votre travail de recherche de fin de formation.</p>
                    </div>
                </div><!-- END COL -->
            </div><!-- END ROW -->
        </div><!-- END CONTAINER -->
    </section>
   
   --}}

    <!-- START WHY CHOOSE US-->
    <section class="marketing_content_area section-padding">
        <div class="container">
            <div class="section-title">
                <h2></h2>
                <p>Pourquoi choisir PAPE.</p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
                    <div class="single_feature_one">
                        <div class="sf_top">
                            <span class="ti-book ss_one"></span>
                            <h2><a href="single-service.html" target="_blank">Expertise et Expériences</a></h2>
                        </div>
                        <p>Plus de 500 étudiants et chercheurs ont déjà bénéficié de notre expertise et en sont satisfaits.</p>
                    </div>
                </div><!-- END COL -->

                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
                    <div class="single_feature_one">
                        <div class="sf_top">
                            <span class="ti-heart ss_two"></span>
                            <h2><a href="single-service.html" target="_blank">Coaching Personnalisé</a></h2>
                        </div>
                        <p>Un suivi personnalisé adapté aux besoins de l’étudiant ou du chercheur.</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                    <div class="single_feature_one">
                        <div class="sf_top">
                            <span class="ti-user ss_three"></span>
                            <h2><a href="single-service.html" target="_blank">Gain de Temps</a></h2>
                        </div>
                        <p>Notre accompagnement vous assure un redoutable gain de temps.</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
                    <div class="single_feature_one">
                        <div class="sf_top">
                            <span class="ti-eye ss_four"></span>
                            <h2><a href="single-service.html" target="_blank">Qualité Garantie</a></h2>
                        </div>
                        <p>Nos coachings respectent les normes universitaires et vous évitent le plagiat.</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s" data-wow-offset="0">
                    <div class="single_feature_one">
                        <div class="sf_top">
                            <span class="ti-light-bulb ss_five"></span>
                            <h2><a href="single-service.html" target="_blank">Confidentialité assurée</a></h2>
                        </div>
                        <p>Nous garantissons la confidentialité totale de vos informations personnelles.</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.6s" data-wow-offset="0">
                    <div class="single_feature_one">
                        <div class="sf_top">
                            <span class="ti-email ss_six"></span>
                            <h2><a href="single-service.html" target="_blank">Service Réactif et Disponible</a></h2>
                        </div>
                        <p>Une équipe toujours disponible pour vous accompagner et pour répondre à vos préoccupations.</p>
                    </div>
                </div><!-- END COL -->
            </div><!-- END ROW -->
        </div><!-- END CONTAINER -->
    </section>

    <section id="counts" class="counts section-padding">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <p>Nos expériences</p>
            </div>
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6">
                    <div class="count-box">
                        <i class="ti-face-smile"></i>
                        <div>
                            <div class="d-flex">
                                <span data-purecounter-start="0" data-purecounter-end="500" data-purecounter-duration="1" class="purecounter"></span>
                                <span>+</span>
                            </div>
                            <p>Étudiants Accompagnés</p>
                        </div>
                    </div>
                </div><!-- END COL -->

                <div class="col-lg-4 col-md-6">
                    <div class="count-box">
                        <i class="ti-headphone-alt" style="color: #15be56;"></i>
                        <div>
                            <div class="d-flex">
                                <span data-purecounter-start="0" data-purecounter-end="752" data-purecounter-duration="1" class="purecounter"></span>
                                <span>+</span>
                            </div>
                            <p>Assistance Fournie</p>
                        </div>
                    </div>
                </div><!-- END COL -->

                <div class="col-lg-4 col-md-6">
                    <div class="count-box">
                        <i class="ti-user" style="color: #bb0852;"></i>
                        <div>
                            <div class="d-flex">
                                <span data-purecounter-start="0" data-purecounter-end="425" data-purecounter-duration="1" class="purecounter"></span>
                                <span>+</span>
                            </div>
                            <p>Clients Satisfaits</p>
                        </div>
                    </div>
                </div><!-- END COL -->
            </div><!-- END ROW -->
        </div><!-- END CONTAINER -->
    </section>
    <!-- END COUNTER -->

    <section class="testi_home_area section-padding">
        <div class="container">
            <div class="section-title">
                <h2>Témoignages</h2>
                <p>Ils nous ont fait confiance</p>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div id="testimonial-slider" class="owl-carousel">
                        <div class="testimonial">
                            <div class="testimonial_content">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <p class="fst-italic">
                                    "Le coaching m'a donné confiance en moi et m'a aidé à gérer mon stress. J’aborde mes études avec plus de sérénité. Merci à l’équipe de PAPE CESIE BENIN !
                                </p>
                            </div>
                            <div class="testi_pic_title tpt_one">
                                <div class="pic">
                                    <img src="{{asset('clients/assets/images/all-img/user.png')}}" alt="" width="30" height="30">
                                </div>
                                <h4> Aïcha D.</h4>
                                <small class="post">Étudiante en Médecine</small>
                            </div>
                        </div>
                        <div class="testimonial">
                            <div class="testimonial_content">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <p class="fst-italic">
                                    "La préparation aux examens avec PAPE Césiebenin a été essentielle pour réussir mon concours. Les méthodes et l'accompagnement sont super efficaces. Je recommande à tous les étudiants !"
                                </p>
                            </div>
                            <div class="testi_pic_title tpt_one">
                                <div class="pic">
                                    <img src="{{asset('clients/assets/images/all-img/user.png')}}" alt="" width="30" height="30">
                                </div>
                                <h4> Lamine S.</h4>
                                <small class="post">Étudiant en Droit</small>
                            </div>
                        </div>
                        <div class="testimonial">
                            <div class="testimonial_content">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <p class="fst-italic">
                                    "J'étais perdu quant à mon orientation, mais l'équipe de PAPE Césiebenin m'a aidé à clarifier mes choix. Maintenant, j'ai une vision claire de mon avenir."
                                </p>
                            </div>
                            <div class="testi_pic_title tpt_one">
                                <div class="pic">
                                    <img src="{{asset('clients/assets/images/all-img/user.png')}}" alt="" width="30" height="30">
                                </div>
                                <h4> Claire M.</h4>
                                <small class="post"> Étudiante en Sciences Sociales</small>
                            </div>
                        </div>
                        <!-- END TESTIMONIAL -->
                    </div><!-- END TESTIMONIAL SLIDER -->
                </div><!-- END COL -->
            </div><!-- END ROW -->
        </div><!-- END CONTAINER -->
    </section>
    <!-- END COURSE -->


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
                                    Qu'est-ce que le PAPE ?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Le PAPE est un Programme d’accompagnement Professionnel des étudiants avec pour objectifs de 
                                    <ul>
                                        <li>👉 Rechercher une administration d’accueil (publique ou privée) à l’étudiant dans le cadre de son stage académique.</li>
                                        <li>👉 Coacher l’étudiant ou le chercheur dans la rédaction de son mémoire ou thèse</li>
                                        <li>👉 Coacher l’étudiant ou le chercheur dans la collecte et l’analyse des données de terrain.</li>
                                        <li>👉 Former l’étudiant ou le chercheur à la conduite des travaux de recherche.</li>
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
                                    Le PAPE offre au-delà des formations et de l’opportunité gratuite de stage, un coaching en :
                                    <ul>
                                        <li>👉Assistance dans la rédaction de mémoire ou de votre thèse</li>
                                        <li>👉Assistance dans la rédaction de votre Protocole de recherche</li>
                                        <li>👉 Analyse des données</li>
                                        <li>👉 Mise en forme du document</li>
                                        {{-- <li>👉 Commande et livraison rapide du mémoire ou de la thèse</li> --}}
                                        <li>👉  Mise à disposition de base de données (commercial) </li>
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
                                    Le programme est destiné aux  :
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
                    </div>
                </div><!-- END COL  -->
            </div><!-- END ROW  -->
        </div><!-- END CONTAINER -->
    </section>
@endsection

@section('extra-scripts')

@endsection
