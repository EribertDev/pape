<div class="main-header">
    @php
        if(session()->has('adminInfo')){
            $adminInfo = session()->get('adminInfo');
        }
    @endphp
    <div class="logo-header">
        <a href="{{route('home')}}"><img src="{{asset('clients/assets/images/icon/logo-syrram.png')}}" style="width: 70px;height: 60px" alt=""></a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
    </div>
    <nav class="navbar navbar-header navbar-expand-lg">
        <div class="container-fluid">
{{-- 
            <form class="navbar-left navbar-form nav-search mr-md-3" action="">
                <div class="input-group">
                    <input type="text" placeholder="Search ..." class="form-control">
                    <div class="input-group-append">
								<span class="input-group-text">
									<i class="la la-search search-icon"></i>
								</span>
                    </div>
                </div>
            </form> --}}
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                {{-- <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="la la-envelope"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li> --}}
                {{-- <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="la la-bell"></i>
                        <span class="notification">3</span>
                    </a>
                    <ul class="dropdown-menu notif-box" aria-labelledby="navbarDropdown">
                        <li>
                            <div class="dropdown-title">You have 4 new notification</div>
                        </li>
                        <li>
                            <div class="notif-center">
                                <a href="#">
                                    <div class="notif-icon notif-primary"> <i class="la la-user-plus"></i> </div>
                                    <div class="notif-content">
												<span class="block">
													New user registered
												</span>
                                        <span class="time">5 minutes ago</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="notif-icon notif-success"> <i class="la la-comment"></i> </div>
                                    <div class="notif-content">
												<span class="block">
													Rahmad commented on Admin
												</span>
                                        <span class="time">12 minutes ago</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="notif-img">
                                        <p style="
                         background-color:rgba(182,13,130,0.89);
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

                       ">{{get_string_initial($adminInfo->last_name. ' ' .$adminInfo->fist_name,2)}}</p>

                                    </div>
                                    <div class="notif-content">
												<span class="block">
													Reza send messages to you
												</span>
                                        <span class="time">12 minutes ago</span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="notif-icon notif-danger"> <i class="la la-heart"></i> </div>
                                    <div class="notif-content">
												<span class="block">
													Farrah liked Admin
												</span>
                                        <span class="time">17 minutes ago</span>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li>
                            <a class="see-all" href="javascript:void(0);"> <strong>See all notifications</strong> <i class="la la-angle-right"></i> </a>
                        </li>
                    </ul>
                </li> --}}
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="{{asset('admin/assets/img/profile.jpg')}}" alt="user-img" width="36" class="img-circle">
                        <span >
                            @php
                                if (isset($adminInfo)){
                                    echo $adminInfo->last_name. ' ' .$adminInfo->fist_name;
                                }
                            @endphp
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <div class="user-box">
                                <div class="u-img"><img src="{{asset('admin/assets/img/profile.jpg')}}" alt="user"></div>
                                <div class="u-text">
                                    <h4>{{$adminInfo->last_name. ' ' .$adminInfo->fist_name}}</h4>
                                    <p class="text-muted">{{\Illuminate\Support\Facades\Auth::user()->email}}</div>
                            </div>
                        </li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="ti-user"></i>Profile</a>
                        {{-- <a class="dropdown-item" href="#"></i> My Balance</a>
                        <a class="dropdown-item" href="#"><i class="ti-email"></i> Inbox</a> --}}
                        {{-- <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="ti-settings"></i> Account Setting</a> --}}
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}" class="col-5"  >
                            @csrf
                            <a class="dropdown-item"  href="{{route('logout')}}" onclick="event.preventDefault();this.closest('form').submit();"><i class="fa fa-power-off"></i> Déconnexion</a>
                            </a>
                        </form>

                    </ul>
                    <!-- /.dropdown-user -->
                </li>
            </ul>
        </div>
    </nav>
</div>