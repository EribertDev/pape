<div class="col-lg-3 col-sm-12 col-xs-12 mt-5 pt-5">
                <div><h2 class="fw-bold mb-4">Salut {{ session('clientInfo') ->fist_name}} 👋</h2></div>
                <div class="sidebar-post">
                    <div class="sidebar_title"><h4>Tableau de Bord</h4></div>
                    <div class="sidebar-banner">
                        <a class="profil-link-active" href="{{route('dash.client')}}">Mes commandes</a>
                        <hr>
                        {{-- <a class="profil-link" href="#">Mes achats</a>
                        <hr>--}}
                        <a class="profil-link" href="{{route('client.profile')}}">Profile</a>
                    </div><!-- END SOCIAL MEDIA POST -->
                </div><!-- END SIDEBAR POST -->
            </div><!--- END COL -->