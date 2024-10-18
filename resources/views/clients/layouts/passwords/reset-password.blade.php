<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description"
        content="PAPE, un service du cabinet CESIE BENIN, est un programme innovant conçu pour accompagner les étudiants et chercheurs dans la rédaction de mémoires et thèses. Ce programme, offre un appui technique tout au long du processus de rédaction, garantissant une qualité optimale et le respect des normes universitaires.">
    <meta name="keywords" content="PAPE,pape,éducation,thème,memoire,thèse,article scientique">
    <meta name="author" content="CESIE BENIN">
    <link rel="icon" href="{{ asset('clients/assets/images/icon/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('clients/assets/images/icon/favicon.ico') }}" type="image/x-icon">
    <!-- SITE TITLE -->
    <title>PAPE</title>
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="{{ asset('clients/assets/bootstrap/css/bootstrap.min.css') }}">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('clients/assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/assets/fonts/themify-icons.css') }}">
    <!--- owl carousel Css-->
    <link rel="stylesheet" href="{{ asset('clients/assets/owlcarousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/assets/owlcarousel/css/owl.theme.css') }}">
    <!--slicknav Css-->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/slicknav.css') }}">
    <!-- MAGNIFIC CSS -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/magnific-popup.css') }}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/animate.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/style.css') }}">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <![endif]-->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
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
    <h1 class="text-white fs-6">PAPE</h1>
    <section class="zero_area section-padding">
        <div class="container">
            <div class="row mt-0">
                <div class="col-lg-12 col-sm-12 col-xs-12 text-center mt-0">
                    <div class="error_page">

                                    <img src="{{asset("clients/assets/images/icon/logo-syrram.png")}}" class="img-fluid" alt="syrram" style="width: 270px;height: 200px">

                        <h3 class="mt-4">Réinitialisation du mot de passe</h2>
                        <div class="row  d-flex justify-content-center">

                            <div class="mt-2">
                                <div class="checkout-form">
                                    <!-- Form -->
                                    <form method="POST" action="/reset-password">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <div class="form-group mt-2">
                                            <label for="email"></label>
                                            <input class="px-2 py-2 col-10 col-md-8 col-lg-6" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Adresse e-mail">
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="password"></label>
                                            <input class="px-2 py-2 col-10 col-md-8 col-lg-6" id="password" type="password" name="password" required placeholder="Nouveau mot de passe">
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="password_confirmation"></label>
                                            <input class="px-2 py-2 col-10 col-md-8 col-lg-6" id="password_confirmation" type="password" name="password_confirmation" required placeholder="Confirmer le mot de passe">
                                        </div>
                                        <div class="form-group mt-2">
                                            <button class="btn_one border border-1 px-2 py-2 col-10 col-md-4 col-lg-4" type="submit">Réinitialiser le mot de passe</button>
                                        </div>
                                    </form>
                                    {{-- <form id="cmdForm"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="row">
                                                <div >
                                                    <div class="form-group mt-2" id="div_email">
                                                        <input class="px-2 py-2 col-10 col-md-8 col-lg-6"  id="email" type="email" name="email" required autofocus />
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <button class="btn_one border border-1 px-2 py-2 col-10 col-md-4 col-lg-4" type="submit">Envoyer </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form> --}}
                                    <!--/ End Form -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END 404 -->

    <!-- Latest jQuery -->
    <script src="{{ asset('clients/assets/js/jquery-1.12.4.min.js') }}"></script>
    <!-- Latest compiled and minified Bootstrap -->
    <script src="{{ asset('clients/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- owl-carousel min js  -->
    <script src="{{ asset('clients/assets/owlcarousel/js/owl.carousel.min.js') }}"></script>
    <!-- jquery.slicknav -->
    <script src="{{ asset('clients/assets/js/jquery.slicknav.js') }}"></script>
    <!-- magnific-popup js -->
    <script src="{{ asset('clients/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- jquery mixitup min js -->
    <script src="{{ asset('clients/assets/js/jquery.mixitup.js') }}"></script>
    <!-- scrolltopcontrol js -->
    <script src="{{ asset('clients/assets/js/scrolltopcontrol.js') }}"></script>
    <!-- jquery purecounter vanilla js -->
    <script src="{{ asset('clients/assets/js/purecounter_vanilla.js') }}"></script>
    <!-- WOW - Reveal Animations When You Scroll -->
    <script src="{{ asset('clients/assets/js/wow.min.js') }}"></script>
    <!-- scripts js -->
    <script src="{{ asset('clients/assets/js/scripts.js') }}"></script>
</body>

</html>
