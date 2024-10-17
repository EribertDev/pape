<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="Penn - Education HTML Template">
        <meta name="keywords" content="PAPE,pape,éducation,thème,memoire,thèse,article scientique">
        <meta name="author" content="theme_ocean">
        <link rel="icon" href="{{ asset('clients/assets/images/icon/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('clients/assets/images/icon/favicon.ico') }}" type="image/x-icon">
        <!-- SITE TITLE -->
        <title>PAPE</title>
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

        {{--@vite(['resources/css/app.css', 'resources/js/app.js'])--}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('extra-style')
    </head>
    <body>

        <!-- Start Header Area -->
        @include('clients.partials.header-1')
        <!-- End Header Area -->

        <!-- Start partials -->
        @yield('page-content')

        <!-- Start Footer Area -->
        @include('clients.partials.footer-1')
        <!--/ End Footer partials -->
        {{--Auth modale--}}
        @guest
            @include('auth.login')
            @include('auth.register')
        @endguest

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
        @guest
            <script src="{{asset('clients/js-data/auth.js')}}"></script>
            <script type="module" src="{{asset('clients/js-data/register.js')}}"></script>
            <script type="module" src="{{asset('clients/js-data/login.js')}}"></script>
        @endguest
        @auth
            <script>
                var isAuthenticated = @json(auth()->check());
            </script>
        @endauth


        @yield('extra-scripts')

    </body>

</html>





