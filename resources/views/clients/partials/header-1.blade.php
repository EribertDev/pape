<!-- START PRELOADER -->
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<!-- END PRELOADER -->

<!-- START NAVBAR -->
<div id="navigation" class="fixed-top navbar-light bg-faded site-navigation">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="site-logo">
                    <a href="{{route('home')}}"><img src="{{asset('clients/assets/images/icon/logo-syrram.png')}}" style="width: 70px;height: 60px" alt=""></a>
                </div>
            </div><!--- END Col -->

            <div class="col-lg-6 col-md-9 col-sm-8 ">
                <div class="header_right justify-content-center">
                    <nav id="main-menu" class="ms-auto ">
                        <ul>
                            <li>
                                <a class="nav-link" href="{{route('home')}}">Accueil</a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{route('a-propos')}}">A propos</a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{route('faqs')}}">FAQ's</a>
                            </li>
                            <li><a class="nav-link" href="{{route('contact')}}">Contact</a></li>
                            @auth
                                <li  class="d-block d-lg-none"><a  href="{{route('dash.client')}}">Mon Espace</a></li>
                                <li  class="d-block d-lg-none"><form method="POST" action="{{ route('logout') }}" class="col-5"  >
                                    @csrf
                                    <a  href="{{route('logout')}}"  onclick="event.preventDefault();this.closest('form').submit();">
                                        Déconnexion
                                    </a>
                                </form></li>
                            @endauth
                            @guest
                                <li class="d-block d-lg-none">
                                    <a  type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Connexion</a>      
                                </li>
                            @endguest
                        </ul>
                    </nav>
                    <div id="mobile_menu"></div>
                </div>
            </div><!--- END Col -->
            @auth
                <div class="col-lg-4 col-md-3 col-sm-8 ms-auto d-none d-lg-block">
                    <div class="call_to_action d-flex">
                        <a class="btn_one col-6" href="{{route('dash.client')}}">Mon Espace</a>
                        <form method="POST" action="{{ route('logout') }}" class="col-5"  >
                            @csrf
                            <a  href="{{route('logout')}}" class="btn_two"  onclick="event.preventDefault();this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </a>
                        </form>
                    </div><!--- END SOCIAL PROFILE -->
                </div>
            @endauth
            @guest
                <div class="col-lg-4 col-md-3 col-sm-8 ms-auto d-none d-lg-block">
                    <div class="call_to_action">
                        <a class="btn_one" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Connexion</a>
                    </div><!--- END SOCIAL PROFILE -->
                </div>
            @endguest

            <!--- END Col -->
        </div><!--- END ROW -->

    </div><!--- END CONTAINER -->
</div>
<!-- END NAVBAR -->