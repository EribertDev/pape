@php use Illuminate\Support\Facades\Hash; @endphp
@extends('clients.master-1')
@section('extra-style')
    <link rel="stylesheet" href="{{asset('clients/assets/css/styles_perso.css')}}"/>
    <style>
        .text-justify{
            text-align: justify;
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
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-xs-12 ">
                    <div class="home_content d-block d-lg-none mt-3 pb-5 text-center">
                        <h2 class="fw-bold text-center"><span>Simplifiez la Rédaction de Vos Documents Académiques et Professionnels</span> avec PAPE</h2>
                        <p class="mt-4  text-center">Un service dédié pour vous accompagner dans la rédaction de mémoires, thèses, articles de recherche, documents administratifs, et autres</p>
                       <div class="row">
                            @guest
                                <div class="col-lg-4 col-md-7 col-sm-8  justify-content-center">
                                    <div class="">
                                        <a class="btn_one" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Connexion</a>
                                    </div><!--- END SOCIAL PROFILE -->
                                </div>
                            @endguest
                            @auth
                                <div class="col-lg-7 col-md-3 col-sm-8 mb-7 d-flex justify-content-center">
                                    <div class="call_to_action">
                                        <a class="btn_one" type="button" href="{{route('service.redaction')}}"> <span>Incrivez-vous maintenant au PAPE</span></a>
                                    </div><!--- END SOCIAL PROFILE -->
                                </div>
                            @endauth
                       </div>
                    </div>
                   <div class="home_content  d-none d-lg-block">
                        <h2 class="fw-bold "><span>Simplifiez la Rédaction de Vos Documents Académiques et Professionnels</span> avec PAPE</h2>
                        <p class="mt-3">Un service dédié pour vous accompagner dans la rédaction de mémoires, thèses, articles de recherche, documents administratifs, et autres</p>
                        <div class="row">
                            @guest
                                <div class="col-lg-3 col-md-3 col-sm-8 ms-2 mb-4">
                                    <div class="call_to_action">
                                        <a class="btn_one" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Connexion</a>
                                    </div><!--- END SOCIAL PROFILE -->
                                </div>
                            @endguest
                            <div class="col-lg-8 col-md-3 col-sm-8 mb-4">
                                <div class="call_to_action">
                                    @auth
                                        <a class="btn_one" type="button" href="{{route('service.redaction')}}"> <span>Incrivez-vous maintenant au PAPE</span></a>
                                    @endauth
                                    @guest
                                        <a class="btn_two" type="button" href="{{route('service.redaction')}}"> <span>Incrivez-vous maintenant au PAPE</span></a>
                                    @endguest
                                </div><!--- END SOCIAL PROFILE -->
                            </div>
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

    <!-- START TOP PROMO FEATURES -->
    <section class="tp_feature">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
                    <div class="single_tp">
                        <h3>Coaching pour la rédaction de vos mémoires et thèses</h3>
                        <p>
                            Faites-vous accompagner par le programme PAPE pour rédiger rapidement, efficacement et sans plagiat vos mémoires de fin de formation.
                        </p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0">
                    <div class="single_tp">
                        <h3>Assistance pour la recherche de stages académiques et professionnels</h3>
                        <p>Inscrivez-vous au programme PAPE pour bénéficier d'opportunités gratuites de stages académiques et professionnels.</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s" data-wow-offset="0">
                    <div class="single_tp">
                        <h3>Collecte et analyse de données pour vos recherches</h3>
                        <p>Le PAPE vous aide à réaliser rapidement vos collectes et analyses de données dans le cadre de votre travail de recherche de fin de formation.</p>
                    </div>
                </div><!-- END COL -->
            </div><!-- END ROW -->
        </div><!-- END CONTAINER -->
    </section>
    <!-- END TOP PROMO FEATURES -->

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
                            <h2><a href="single-service.html" target="_blank">Expertise et Expérience</a></h2>
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
                        <p>Notre accompagnement vous garantit un gain de temps considérable.</p>
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
                            <h2><a href="single-service.html" target="_blank">Confidentialité Assurée</a></h2>
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
                        <p>Une équipe toujours disponible pour vous accompagner et répondre à vos préoccupations.</p>
                    </div>
                </div><!-- END COL -->
            </div><!-- END ROW -->
        </div><!-- END CONTAINER -->
    </section>

    <!-- END WHY CHOOSE US -->

    <!-- START COURSE PROMOTION -->
    {{-- <section class="course_promo section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s"
                     data-wow-offset="0">
                    <div class="cp_content">
                        <h2>Prêt à vous lancez?</h2>
                        {{-- <p>Commander un mémoire maintenant et bénéficier d'une <u>50%</u> de réduction</p>
                        <ul>
                            <li><span class="ti-check"></span>9/10 Average Satisfaction Rate</li>
                            <li><span class="ti-check"></span>96% Completitation Rate</li>
                            <li><span class="ti-check"></span>Friendly Environment & Expert Teacher</li>
                        </ul>
                    </div>
                    <div class="cp_btn">
                        <a href="{{route('service.redaction')}}" class="cta"><span>Incrivez-vous maintenant</span>
                            <svg width="13px" height="10px" viewBox="0 0 13 10">
                                <path d="M1,5 L11,5"></path>
                                <polyline points="8 1 12 5 8 9"></polyline>
                            </svg>
                        </a>
                    </div>
                </div><!--- END COL -->
                <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s"
                     data-wow-offset="0">
                    <div class="cp_img">
                        <img src="{{asset('clients/assets/images/all-img/promo.png')}}" class="img-fluid" alt="image">
                        <!-- <div class="wc_year">
                            <h3>20 Years of Experience <br />from 2002</h3>
                        </div> -->
                    </div>
                </div><!--- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section> --}}
    <!-- END COURSE PROMOTION -->

    <!--START COURSE -->
    {{-- <div class="best-cpurse section-padding">
        <div class="container">
            <div class="section-title">
                <h2>Sujets et thème de mémoire d'actualités </h2>
                <p>Bibliothèque de thèmes de mémoires </p>
            </div>
            <div class="row">
                @if(!empty($categories))
                    @foreach($categories->take(6) as $categorie)
                        @php
                            $info = json_decode($categorie->info, true, 512, JSON_THROW_ON_ERROR);
                        @endphp
                        <div class="col-lg-4 col-sm-6 col-xs-12">
                            <div class="single_tca">
                                <img src="{{asset($info["icon_path"])}}" alt=""/>
                                <h2><a href="#">{{$categorie->name}}</a></h2>
                                <span>+{{$info["theme_count"]}} Thèmes</span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div><!-- END ROW -->
            <div class="col-lg-12 text-center">
                <div class="cc_btn">
                    <a class="btn_one" href="{{route('tm.all')}}">Voir Plus</a>
                </div>
            </div><!--END COL -->
        </div><!--END CONTAINER -->
    </div> --}}
    <!--END COURSE -->
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
                                <span data-purecounter-start="0" data-purecounter-end="100" data-purecounter-duration="1" class="purecounter"></span>
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
                                <span data-purecounter-start="0" data-purecounter-end="252" data-purecounter-duration="1" class="purecounter"></span>
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
                                <span data-purecounter-start="0" data-purecounter-end="324" data-purecounter-duration="1" class="purecounter"></span>
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
                                <p>Grâce à [Nom du service], j'ai pu finaliser mon mémoire dans les délais et avec une qualité exceptionnelle.</p>
                            </div>
                            <div class="testi_pic_title tpt_one">
                                <div class="pic">
                                    <img src="{{asset('clients/assets/images/all-img/t2.png')}}" alt="">
                                </div>
                                <h4>James Clayton</h4>
                                <small class="post">- Expert en Design</small>
                            </div>
                        </div><!-- END TESTIMONIAL -->

                        <div class="testimonial">
                            <div class="testimonial_content">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <p>L'équipe m'a aidé à structurer et rédiger mon document administratif avec une grande efficacité.</p>
                            </div>
                            <div class="testi_pic_title tpt_two">
                                <div class="pic">
                                    <img src="{{asset('clients/assets/images/all-img/t2.png')}}" alt="">
                                </div>
                                <h4>James Simmons</h4>
                                <small class="post">- Expert en Marketing</small>
                            </div>
                        </div><!-- END TESTIMONIAL -->

                        <div class="testimonial">
                            <div class="testimonial_content">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <p>Un service exceptionnel qui m'a permis d'atteindre mes objectifs avec succès.</p>
                            </div>
                            <div class="testi_pic_title tpt_three">
                                <div class="pic">
                                    <img src="{{asset('clients/assets/images/all-img/t2.png')}}" alt="">
                                </div>
                                <h4>Alex Feroundo</h4>
                                <small class="post">- Fondateur</small>
                            </div>
                        </div><!-- END TESTIMONIAL -->

                        <div class="testimonial">
                            <div class="testimonial_content">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <p>Le soutien apporté a été inestimable et a fait toute la différence.</p>
                            </div>
                            <div class="testi_pic_title tpt_one">
                                <div class="pic">
                                    <img src="{{asset('clients/assets/images/all-img/t2.png')}}" alt="">
                                </div>
                                <h4>Kallu Mastan</h4>
                                <small class="post">- Mastan Group</small>
                            </div>
                        </div><!-- END TESTIMONIAL -->

                        <div class="testimonial">
                            <div class="testimonial_content">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <p>Une expérience enrichissante qui a dépassé mes attentes.</p>
                            </div>
                            <div class="testi_pic_title tpt_two">
                                <div class="pic">
                                    <img src="{{asset('clients/assets/images/all-img/t2.png')}}" alt="">
                                </div>
                                <h4>Devid Max</h4>
                                <small class="post">- Max Inc.</small>
                            </div>
                        </div><!-- END TESTIMONIAL -->
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
                                    Qu’est-ce que le PAPE ?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Le PAPE est un Programme d’accompagnement Professionnel des Étudiants, visant à :
                                    <ul>
                                        <li>👉 Rechercher une administration d’accueil (publique ou privée) pour l'étudiant dans le cadre de son stage éducatif.</li>
                                        <li>👉 Coacher l'étudiant ou le chercheur dans la rédaction de son mémoire ou de sa thèse.</li>
                                        <li>👉 Accompagner l'étudiant ou le chercheur dans la collecte et l’analyse des données de terrain.</li>
                                        <li>👉 Former l'étudiant ou le chercheur à la conduite de projets de recherche.</li>
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
                                    Le PAPE propose, au-delà des formations et de l’opportunité gratuite de stage, un coaching en :
                                    <ul>
                                        <li>👉 Rédaction complète du mémoire ou de la thèse.</li>
                                        <li>👉 Élaboration de protocoles de recherche.</li>
                                        <li>👉 Analyse des données.</li>
                                        <li>👉 Mise en forme des documents.</li>
                                        <li>👉 Commande et livraison rapide de mémoires ou thèses.</li>
                                        <li>👉 Vente de bases de données issues des collectes de données.</li>
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
                                    Le programme s'adresse à :
                                    <ul>
                                        <li>👉 Étudiants ou chercheurs.</li>
                                        <li>👉 Particuliers.</li>
                                        <li>👉 Administrations.</li>
                                        <li>👉 Toute personne désireuse d’acquérir des compétences en conduite d’études ou de recherches.</li>
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
                                    Pour bénéficier du PAPE, vous devez exprimer vos requêtes via la plateforme du programme.
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

    <script>

    </script>

@endsection
