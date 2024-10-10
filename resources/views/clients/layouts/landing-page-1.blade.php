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
        $bd = $data["bd"];
    @endphp
    <section id="home" class="home_bg"
             style="background-image: url({{asset('clients/assets/images/banner/home.png')}});  background-size:cover; background-position: center center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-xs-12 ">
                    <div class="home_content d-block d-lg-none mt-3 pb-5 text-center">
                        <h2 class="fw-bold text-center"><span>Simplifiez la Rédaction de Vos Documents Académiques et Professionnels</span> avec SyRRaM</h2>
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
                                        <a class="btn_one" type="button" href="{{route('service.redaction')}}"> <span>Commander maintenant</span></a>
                                    </div><!--- END SOCIAL PROFILE -->
                                </div>
                            @endauth
                       </div>
                    </div>
                   <div class="home_content  d-none d-lg-block">
                        <h2 class="fw-bold "><span>Simplifiez la Rédaction de Vos Documents Académiques et Professionnels</span> avec SyRRaM</h2>
                        <p class="mt-3">Un service dédié pour vous accompagner dans la rédaction de mémoires, thèses, articles de recherche, documents administratifs, et autres</p>
                        <div class="row">
                            @guest
                                <div class="col-lg-4 col-md-3 col-sm-8 ms-2 mb-4">
                                    <div class="call_to_action">
                                        <a class="btn_one" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Connexion</a>
                                    </div><!--- END SOCIAL PROFILE -->
                                </div>
                            @endguest
                            <div class="col-lg-7 col-md-3 col-sm-8 mb-4">
                                <div class="call_to_action">
                                    @auth
                                        <a class="btn_one" type="button" href="{{route('service.redaction')}}"> <span>Commander maintenant</span></a> 
                                    @endauth
                                    @guest
                                        <a class="btn_two" type="button" href="{{route('service.redaction')}}"> <span>Commander maintenant</span></a> 
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
                <div class="col-lg-4 col-md-4 col-12 no-padding wow fadeInUp" data-wow-duration="1s"
                     data-wow-delay="0.2s" data-wow-offset="0">
                    <div class="single_tp">
                        <h3>Accompagnement dans la rédaction de mémoires et thèses</h3>
                        <p>Accompagnement dans la rédaction de mémoires et thèses, garantissant qualité et conformité
                            académique.</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s"
                     data-wow-delay="0.3s" data-wow-offset="0">
                    <div class="single_tp">
                        <h3>Assistance pour la rédaction de documents administratifs</h3>
                        <p>Profitez de notre expertise pour rédiger vos documents administratifs avec précision, en
                            respectant les normes et exigences.</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-4 col-xs-12 no-padding wow fadeInUp" data-wow-duration="1s"
                     data-wow-delay="0.4s" data-wow-offset="0">
                    <div class="single_tp">
                        <h3>Collecte et analyse de données pour vos recherches</h3>
                        <p>SyRRaM collecte et analyse des données fiables pour appuyer vos recherches, offrant des
                            résultats précis et exploitables.</p>
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
                <p>Pourquoi choisir Syrram.</p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s"
                     data-wow-offset="0">
                    <div class="single_feature_one">
                        <div class="sf_top">
                            <span class="ti-book ss_one"></span>
                            <h2><a href="single-service.html" target="_blank">Expertise et Expérience</a></h2>
                        </div>
                        <p>Encadrement professionnel pour aider les étudiants à chaque étape de la rédaction
                            académique.</p>
                    </div>
                </div><!-- END COL -->


                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s"
                     data-wow-offset="0">
                    <div class="single_feature_one">
                        <div class="sf_top">
                            <span class="ti-heart ss_two"></span>
                            <h2><a href="single-service.html" target="_blank">Accompagnement Personnalisé</a></h2>
                        </div>
                        <p>Un suivi sur mesure adapté aux besoins spécifiques, du protocole de recherche à la mise en
                            forme finale.</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s"
                     data-wow-offset="0">
                    <div class="single_feature_one">
                        <div class="sf_top">
                            <span class="ti-user ss_three"></span>
                            <h2><a href="single-service.html" target="_blank">Gain de Temps</a></h2>
                        </div>
                        <p>Optimisation de chaque étape de la rédaction pour produire rapidement des travaux de haute
                            qualité.</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s"
                     data-wow-offset="0">
                    <div class="single_feature_one">
                        <div class="sf_top">
                            <span class="ti-eye ss_four"></span>
                            <h2><a href="single-service.html" target="_blank">Qualité Garantie</a></h2>
                        </div>
                        <p>Les travaux respectent les normes académiques, avec rigueur scientifique et cohérence du
                            contenu.</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s"
                     data-wow-offset="0">
                    <div class="single_feature_one">
                        <div class="sf_top">
                            <span class="ti-light-bulb ss_five"></span>
                            <h2><a href="single-service.html" target="_blank">Confidentialité Assurée</a></h2>
                        </div>
                        <p>Vos données sont protégées et SyRRaM garantit la confidentialité totale de vos documents
                            soumis.</p>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.6s"
                     data-wow-offset="0">
                    <div class="single_feature_one">
                        <div class="sf_top">
                            <span class="ti-email ss_six"></span>
                            <h2><a href="single-service.html" target="_blank">Service Réactif et Disponible</a></h2>
                        </div>
                        <p>Une équipe toujours disponible pour vous accompagner rapidement et répondre à vos
                            questions.</p>
                    </div>
                </div><!-- END COL -->
            </div><!-- END ROW -->
        </div><!-- END CONTAINER -->
    </section>
    <!-- END WHY CHOOSE US -->

    <!-- START COURSE PROMOTION -->
    <section class="course_promo section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s"
                     data-wow-offset="0">
                    <div class="cp_content">
                        <h2>Prêt à vous lancez?</h2>
                        <p>Commander un mémoire maintenant et bénéficier d'une <u>50%</u> de réduction</p>
                        <ul>
                            <li><span class="ti-check"></span>9/10 Average Satisfaction Rate</li>
                            <li><span class="ti-check"></span>96% Completitation Rate</li>
                            <li><span class="ti-check"></span>Friendly Environment & Expert Teacher</li>
                        </ul>
                    </div>
                    <div class="cp_btn">
                        <a href="{{route('service.redaction')}}" class="cta"><span>Commander maintenant</span>
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
    </section>
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
                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <i class="ti-face-smile"></i>
                        <div>
                            <div class="d-flex"><span data-purecounter-start="0" data-purecounter-end="100"
                                                      data-purecounter-duration="1"
                                                      class="purecounter"></span><span>+</span></div>
                            <p>Étudiants Accompagnées</p>
                        </div>
                    </div>
                </div><!--- END COL -->
                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <i class="ti-files" style="color: #ee6c20;"></i>
                        <div>
                            <div class="d-flex"><span data-purecounter-start="0" data-purecounter-end="312"
                                                      data-purecounter-duration="1"
                                                      class="purecounter"></span><span>+</span></div>
                            <p>Document Rédiger</p>
                        </div>
                    </div>
                </div><!--- END COL -->
                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <i class="ti-headphone-alt" style="color: #15be56;"></i>
                        <div>
                            <div class="d-flex"><span data-purecounter-start="0" data-purecounter-end="252"
                                                      data-purecounter-duration="1"
                                                      class="purecounter"></span><span>+</span></div>
                            <p>Assistées</p>
                        </div>
                    </div>
                </div><!--- END COL -->
                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <i class="ti-user" style="color: #bb0852;"></i>
                        <div>
                            <div class="d-flex"><span data-purecounter-start="0" data-purecounter-end="324"
                                                      data-purecounter-duration="1"
                                                      class="purecounter"></span><span>+</span></div>
                            <p>Clients</p>
                        </div>
                    </div>
                </div><!--- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
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
                                <p>Grâce à [Nom du service], j'ai pu finaliser mon mémoire dans les délais et avec une
                                    qualité exceptionnelle.</p>
                            </div>
                            <div class="testi_pic_title tpt_one">
                                <div class="pic">
                                    <img src="{{asset('clients/assets/images/all-img/t2.png')}}" alt="">
                                </div>
                                <h4>James Clayton</h4>
                                <small class="post">- Design Expert</small>
                            </div>
                        </div><!-- END TESTIMONIAL -->
                        <div class="testimonial">
                            <div class="testimonial_content">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <p>L'équipe m'a aidé à structurer et rédiger mon document administratif avec une grande
                                    efficacité.</p>
                            </div>
                            <div class="testi_pic_title tpt_two">
                                <div class="pic">
                                    <img src="{{asset('clients/assets/images/all-img/t2.png')}}" alt="">
                                </div>
                                <h4>James Simmons</h4>
                                <small class="post">- Marketing Expert</small>
                            </div>
                        </div><!-- END TESTIMONIAL -->
                        <div class="testimonial">
                            <div class="testimonial_content">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr sed diam nonumy eirmod
                                    tempor.</p>
                            </div>
                            <div class="testi_pic_title tpt_three">
                                <div class="pic">
                                    <img src="{{asset('clients/assets/images/all-img/t2.png')}}" alt="">

                                </div>
                                <h4>Alex feroundo</h4>
                                <small class="post">- Founder</small>
                            </div>
                        </div><!-- END TESTIMONIAL -->
                        <div class="testimonial">
                            <div class="testimonial_content">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr sed diam nonumy eirmod
                                    tempor.</p>
                            </div>
                            <div class="testi_pic_title tpt_one">
                                <div class="pic">
                                    <img src="{{asset('clients/assets/images/all-img/t2.png')}}" alt="">
                                </div>
                                <h4>Kallu Mastan</h4>
                                <small class="post">- Mastan group</small>
                            </div>
                        </div><!-- END TESTIMONIAL -->
                        <div class="testimonial">
                            <div class="testimonial_content">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr sed diam nonumy eirmod
                                    tempor.</p>
                            </div>
                            <div class="testi_pic_title tpt_two">
                                <div class="pic">
                                    <img src="{{asset('clients/assets/images/all-img/t2.png')}}" alt="">

                                </div>
                                <h4>Devid max</h4>
                                <small class="post">- Max iNC</small>
                            </div>
                        </div><!-- END TESTIMONIAL -->
                    </div><!-- END TESTIMONIAL SLIDER -->
                </div><!-- END COL  -->
            </div><!-- END ROW -->
        </div><!-- END CONTAINER -->
    </section>
    <!--END COURSE -->

    <section class="faq_area section-padding">
        <div class="container">
            <div class="section-title-two">
                <h2>FAQ</h2>
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
                                    SyRRaM est un système digital conçu pour encadrer les étudiants et chercheurs dans
                                    la rédaction de mémoires et thèses. Il offre un appui technique tout au long du
                                    processus de rédaction, depuis la revue documentaire jusqu’à l’analyse des données.
                                    Le système permet une rédaction rapide, efficace et conforme aux normes
                                    universitaires.
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
                                    SyRRaM propose une large gamme de services pour la rédaction de mémoires et de
                                    thèses, notamment :
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
                                    SyRRaM est destiné aux étudiants et chercheurs qui travaillent sur des mémoires, des
                                    thèses ou tout autre travail de recherche. Il convient aussi bien aux débutants
                                    qu’aux chercheurs confirmés qui cherchent à optimiser leur temps et la qualité de
                                    leur rédaction.
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
                                    Vous pouvez passer commande directement sur la plateforme. Après avoir spécifié vos
                                    besoins et les informations nécessaires, le système s’occupe de rédiger le mémoire
                                    ou la thèse et vous le livre dans un délai record.
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
                                    Absolument. Le système inclut des outils et un accompagnement pour l'analyse des
                                    données. Vous pouvez soumettre vos données et recevoir une analyse complète qui
                                    répond aux exigences de votre recherche.
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

    <script>

    </script>

@endsection
