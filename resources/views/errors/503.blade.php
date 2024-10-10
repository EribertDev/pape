<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Penn - Education HTML Template">
    <meta name="keywords" content="theme_ocean, college, course, e-learning, education, high school, kids, learning, online, online courses, school, student, teacher, tutor, university">
    <meta name="author" content="theme_ocean">
    <!-- SITE TITLE -->
    <title>SyRRam</title>
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="{{asset('clients/assets/bootstrap/css/bootstrap.min.css')}}">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{asset('clients/assets/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('clients/assets/fonts/themify-icons.css')}}">
    <!--- owl carousel Css-->
    <link rel="stylesheet" href="{{asset('clients/assets/owlcarousel/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('clients/assets/owlcarousel/css/owl.theme.css')}}">
    <!--slicknav Css-->
    <link rel="stylesheet" href="{{asset('clients/assets/css/slicknav.css')}}">
    <!-- MAGNIFIC CSS -->
    <link rel="stylesheet" href="{{asset('clients/assets/css/magnific-popup.css')}}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{asset('clients/assets/css/animate.css')}}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('clients/assets/css/style.css')}}">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <![endif]-->
    {{--@vite(['resources/css/app.css', 'resources/js/app.js'])--}}
    @yield('extra-style')
</head>
<body class="loaded">

        <!-- START PRELOADER -->
        <div id="loader-wrapper">
            <div id="loader"></div>
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
        <!-- END PRELOADER -->

            <!-- START 404 -->
            <h1 class="text-white fs-6">SyRRaM</h1>
            <section class="zero_area section-padding">
                <div class="container">
                    <div class="row mt-0">
                        <div class="col-lg-12 col-sm-12 col-xs-12 text-center mt-0">
                            <div class="error_page">
                                <img src="{{asset("clients/assets/images/icon/logo-syrram.png")}}" class="img-fluid" alt="syrram" style="width: 230px;height: 200px">
                                <h2 class="mt-0">Bientôt disponible</h2>
                                <div class="d-flex justify-content-center">
                                    <div class="text-start">
                                        <ul style="list-style: circle!important; lighting-color: black">
                                            <li><span>👉</span> Rédaction de thèses, mémoires et articles scientifiques</li>
                                            <li><span>👉</span> Études statistiques et analyses de données</li>
                                            <li><span>👉</span> Vente de données issues de collectes déjà prêtes</li>
                                            <li><span>👉</span> Bibliothèque de mémoires et de projets</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class=" d-flex justify-content-center my-3">
                                    <div class="pd_social_icon fs-4">
                                        <a href="https://www.facebook.com/CESIEofficiel?mibextid=ZbWKwL"><i class="fa fa-facebook"></i></a>
                                        <a href="https://wa.me/22962435929"><i class="fa fa-whatsapp"></i></a>
                                        <a href="https://www.youtube.com/@CabinetCESIE"><i class="fa fa-youtube-play"></i></a>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="text-start fs-5">
                                        <ul>
                                            <li><i class="fa fa-phone"></i>  <a href="tel:+22962435929" style="color: #2eca7f !important;" ><span>+229 624359290</span></a></li>
                                            <li><span><i class="fa fa-globe"></i></span> <a href="https://cesiebenin.com/" style="color: #2eca7f !important;">www.cesiebenin.com</a></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div><!--- END COL -->
                    </div><!--- END ROW -->
                </div><!--- END CONTAINER -->
            </section>
            <!-- END 404 -->

            <!-- Latest jQuery -->
            <script src="{{asset('clients/assets/js/jquery-1.12.4.min.js')}}"></script>
            <!-- Latest compiled and minified Bootstrap -->
            <script src="{{asset('clients/assets/bootstrap/js/bootstrap.min.js')}}"></script>
            <!-- owl-carousel min js  -->
            <script src="{{asset('clients/assets/owlcarousel/js/owl.carousel.min.js')}}"></script>
            <!-- jquery.slicknav -->
            <script src="{{asset('clients/assets/js/jquery.slicknav.js')}}"></script>
            <!-- magnific-popup js -->
            <script src="{{asset('clients/assets/js/jquery.magnific-popup.min.js')}}"></script>
            <!-- jquery mixitup min js -->
            <script src="{{asset('clients/assets/js/jquery.mixitup.js')}}"></script>
            <!-- scrolltopcontrol js -->
            <script src="{{asset('clients/assets/js/scrolltopcontrol.js')}}"></script>
            <!-- jquery purecounter vanilla js -->
            <script src="{{asset('clients/assets/js/purecounter_vanilla.js')}}"></script>
            <!-- WOW - Reveal Animations When You Scroll -->
            <script src="{{asset('clients/assets/js/wow.min.js')}}"></script>
            <!-- scripts js -->
            <script src="{{asset('clients/assets/js/scripts.js')}}"></script>
</body>

</html>
