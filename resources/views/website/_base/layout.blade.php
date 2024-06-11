<!doctype html>
<html lang="en">
    <head>
        @section('meta')
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-touch-icon.png') }}">
            <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png') }}">
            <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png') }}">
            <link rel="manifest" href="{{ asset('assets/favicon/site.webmanifest') }}">
            <meta name="facebook-domain-verification" content="owdh6ky8j92l5yhedr9az5q9d17oo7" />
        @show
        <title>@yield('title')</title>
        @section('css')
            <link href="{{ asset('assets/web/global/css/bootstrap-4.css') }}" rel="stylesheet">
            <link rel="stylesheet" href="{{ asset('assets/web/global/css/swiper.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/web/custom/css/style.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/web/custom/css/deskcall.client.css') }}"> 
            <link rel="stylesheet" href="{{ asset('assets/web/custom/css/buttonPro.css') }}">
        @show
        @section('script-top')

        <script src="{{ asset('assets/web/global/js/compare.datetime.beyond.js') }}"></script>

        <script src="{{ asset('assets/web/global/js/custom.beyond.js') }}"></script>
        <script src="{{ asset('assets/web/global/js/timer.beyond.js') }}"></script>
        <script src="{{ asset('assets/web/global/js/idle.beyond.js') }}"></script>
        {{-- @if($this->session->userdata('release_ID') || $getReleasesDb->num_rows() > 0)
            <script src="<?php echo(base_url()); ?>dist/assets/js/releases.beyond.js"></script>
        @endif --}}

        <script src="{{ asset('assets/web/global/js/timer.counter.beyond.js') }}"></script>
        @show
    </head>
    <body>
        @section('header')

        @show
        @yield('content')

        @section('footer')

        @show

        @section('script-bottom')
            <script type="text/javascript" src="{{asset('dist/jQuery-Timepicker-Addon-master/dist/jquery-ui-timepicker-addon.js')}}"></script>
            <script type="text/javascript" src="{{asset('dist/jQuery-Timepicker-Addon-master/dist/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>
            <script type="text/javascript" src="{{asset('dist/jQuery-Timepicker-Addon-master/dist/jquery-ui-sliderAccess.js')}}"></script>
            <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
            <script src="{{ asset('assets/web/global/js/popper.js') }}"></script>
            <script src="{{ asset('assets/web/global/js/bootstrap4.js') }}"></script>
        @show
    </body>
</html>
