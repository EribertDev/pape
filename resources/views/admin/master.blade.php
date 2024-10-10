<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Syrram-Admin-dash</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('admin/assets/css/bootstrap.min.css')}}">
        <!-- Font Awesome -->
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
            rel="stylesheet"
        />

        <!-- Google Fonts -->
        <link
            href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
            rel="stylesheet"
        />
        <!-- MDB -->
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css"
            rel="stylesheet"
        />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{asset('admin/assets/css/ready.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/css/demo.css')}}">
        @yield('extra-style')
</head>
    <body>
        <div class="wrapper">
           @include('admin.partials.header')
            @include('admin.partials.sidebar')
            <div class="main-panel">
                @yield('page-content')
               {{-- @include('admin.partials.footer')--}}
            </div>
        </div>
        <!-- MDB -->
        <script
            type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"
        ></script>
        <script src="{{asset('admin/assets/js/core/jquery.3.2.1.min.js')}}"></script>
        <script src="{{asset('admin/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
        <script src="{{asset('admin/assets/js/core/popper.min.js')}}"></script>
        <script src="{{asset('admin/assets/js/core/bootstrap.min.js')}}"></script>
        <script src="{{asset('admin/assets/js/plugin/chartist/chartist.min.js')}}"></script>
        <script src="{{asset('admin/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
        <script src="{{asset('admin/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js')}}"></script>
        <script src="{{asset('admin/assets/js/plugin/jquery-mapael/jquery.mapael.min.js')}}"></script>
        <script src="{{asset('admin/assets/js/plugin/jquery-mapael/maps/world_countries.min.js')}}"></script>
        <script src="{{asset('admin/assets/js/plugin/chart-circle/circles.min.js')}}"></script>
        <script src="{{asset('admin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
        <script src="{{asset('admin/assets/js/ready.min.js')}}"></script>
        {{--<script src="{{asset('admin/assets/js/demo.js')}}"></script>--}}
        @yield('extra-scripts')
    </body>
</html>
