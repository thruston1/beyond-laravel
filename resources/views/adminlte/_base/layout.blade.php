<!DOCTYPE html>
<html lang="en">
<head>
    @section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/favicon/site.webmanifest') }}">
    @show

    <title>{{ env('WEBSITE_NAME') }} | @yield('title')</title>

    @section('css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('assets/cms/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/cms/css/main.css') }}">
    @show
    @section('script-top')
    @show
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>

        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="{{ route('admin.profile') }}" class="dropdown-item dropdown-footer">
                        {{ session('admin_name')  }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.logout') }}" class="dropdown-item dropdown-footer">
                        @lang('general.sign_out')
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar bg-danger nav-text sidebar-light-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('admin') }}" class="brand-link">
            <!--
            <img src="{{ asset('assets/html/images/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            -->
            <span class="brand-text font-weight-light">{{ substr(env('WEBSITE_NAME'), 0, 2) }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    {!! generateMenu() !!}

                    <li class="nav-item">
                        <a href="{{ route('admin.logout') }}" class="nav-link">
                            <i class="nav-icon fas fa-power-off"></i>
                            <p>
                                @lang('general.logout')
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> {{ env('WEBSITE_VERSION', '1.0.0') }}
        </div>
        <strong>Copyright &copy; {{ date('Y') }} {{ env('WEBSITE_NAME') }}.</strong> All rights reserved.
    </footer>

</div>
<!-- ./wrapper -->

@section('script-bottom')
<script src="{{ asset('assets/cms/js/app.js') }}"></script>
<script src="{{ asset('assets/cms/js/toastr.js') }}"></script>
@if(session()->has('message'))
    <?php
    switch (session()->get('message_alert')) {
        case 2 : $type = 'success'; break;
        case 3 : $type = 'info'; break;
        default : $type = 'danger'; break;
    }
    ?>
    <script type="text/javascript">
        'use strict';
        @if(session()->get('message_alert') == 1)
        toastr.error('{!! session()->get('message') !!}')
        @elseif(session()->get('message_alert') == 2)
        toastr.success('{!! session()->get('message') !!}')
        @else
        toastr.info('{!! session()->get('message') !!}')
        @endif
    </script>
@endif
@show
</body>
</html>
