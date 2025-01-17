<div class="sidebar">
    @php
        if (session()->has('adminInfo')) {
            $adminInfo = session()->get('adminInfo');
        }
    @endphp

    <div class="scrollbar-inner sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <p
                    style="
                         background-color:rgba(230, 19, 166, 0.89);
                         width: 40px ;
                         height: 40px;
                         border-radius: 50px;
                         text-align: center;
                         color: white;
                         font-weight: bold;
                         font-size: 1.2rem;
                         display: flex;
                         justify-content: center;
                         align-items: center;

                       ">
                    {{ get_string_initial($adminInfo->last_name . ' ' . $adminInfo->fist_name, 2) }}</p>
            </div>
            <div class="info">
                <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                    <span>
                        @php
                            if (isset($adminInfo)) {
                                echo $adminInfo->last_name . ' ' . $adminInfo->fist_name;
                                echo '<span class="user-level">' . session()->get('role') . '</span>';
                            }
                        @endphp

                        {{-- <span class="caret"></span> --}}
                    </span>
                </a>
                <div class="clearfix"></div>

                {{-- <div class="collapse in" id="collapseExample" aria-expanded="true" style="">
                    <ul class="nav">
                        <li>
                            <a href="#profile">
                                <span class="link-collapse">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#edit">
                                <span class="link-collapse">Edit Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#settings">
                                <span class="link-collapse">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div> --}}
            </div>
        </div>
        @if (session()->has('role') && session()->get('role') == 'Affilier')
            <ul class="nav">
                @if (Route::has('admin.dash'))
                    <li class="{{ Request::is('admin/dash') ? 'nav-item active' : 'nav-item' }}">
                        <a href="{{ route('admin.dash') }}">
                            <i class="la la-dashboard"></i>
                            <p>Dashboard</p>
                            {{-- <span class="badge badge-count">5</span> --}}
                        </a>
                    </li>
                @endif
                @if(Route::has('logout'))
                    <li class="{{ Request::is(['admin/staff']) ? 'nav-item active' : 'nav-item' }}">
                        <a href="{{route('admin.staff')}}">
                            <i class="la la-dashboard"></i>
                            <p>Déconnexion</p>
                            {{-- <span class="badge badge-count">5</span>--}}
                        </a>
                    </li>
                @endif
            </ul>
        @else
            <ul class="nav">
                @if (Route::has('admin.dash'))
                    <li class="{{ Request::is('admin/dash') ? 'nav-item active' : 'nav-item' }}">
                        <a href="{{ route('admin.dash') }}">
                            <i class="la la-dashboard"></i>
                            <p>Dashboard</p>
                            {{-- <span class="badge badge-count">5</span> --}}
                        </a>
                    </li>
                @endif

                @if (Route::has('admin.commande'))
                    <li
                        class="{{ Request::is(['admin/commande', '/admin/commande/get/{uuid}']) ? 'nav-item active' : 'nav-item' }}">
                        <a href="{{ route('admin.commande') }}">
                            <i class="la la-dashboard"></i>
                            <p>Commandes</p>
                            {{-- <span class="badge badge-count">5</span> --}}
                        </a>
                    </li>
                @endif
                @if (Route::has('admin.theme-memoire'))
                    <li class="{{ Request::is(['admin/theme-memoire']) ? 'nav-item active' : 'nav-item' }}">
                        <a href="{{ route('admin.theme-memoire') }}">
                            <i class="la la-dashboard"></i>
                            <p>Bibliothèque</p>
                            {{-- <span class="badge badge-count">5</span> --}}
                        </a>
                    </li>
                @endif
                @if (Route::has('admin.payements'))
                    <li class="{{ Request::is(['admin/payements']) ? 'nav-item active' : 'nav-item' }}">
                        <a href="{{ route('admin.payements') }}">
                            <i class="la la-dashboard"></i>
                            <p>Payements</p>
                            {{-- <span class="badge badge-count">5</span> --}}
                        </a>
                    </li>
                @endif
                @if (Route::has('admin.staff') && session()->get('role') == 'Administrateur')
                    <li class="{{ Request::is(['admin/staff']) ? 'nav-item active' : 'nav-item' }}">
                        <a href="{{ route('admin.staff') }}">
                            <i class="la la-dashboard"></i>
                            <p>Equipe</p>
                            {{-- <span class="badge badge-count">5</span> --}}
                        </a>
                    </li>
                @endif
                 @if (Route::has('admin.base-donne'))
                <li class="{{ Request::is(['admin/base-donne']) ? 'nav-item active' : 'nav-item' }}">
                    <a href="{{route('admin.base-donne')}}">
                        <i class="la la-dashboard"></i>
                        <p>Base de données</p>
                    </a>
                </li>
            @endif 

                {{-- @if (Route::has('admin.staff'))
                <li class="{{ Request::is(['admin/staff']) ? 'nav-item active' : 'nav-item' }}">
                    <a href="{{route('admin.staff')}}">
                        <i class="la la-dashboard"></i>
                        <p>Ventes</p>
                        {{-- <span class="badge badge-count">5</span>
                    </a>
                </li>
            @endif --}}
                @if (Route::has('logout'))
                    <li class="{{ Request::is(['admin/staff']) ? 'nav-item active' : 'nav-item' }}">
                        <a href="{{ route('admin.staff') }}">
                            <i class="la la-dashboard"></i>
                            <p>Déconnexion</p>
                            {{-- <span class="badge badge-count">5</span> --}}
                        </a>
                    </li>
                @endif
            </ul>
        @endif

    </div>
</div>
