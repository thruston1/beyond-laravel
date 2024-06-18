<!doctype html>
<html lang="en">
    <head>
        @section('meta')
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            {{-- <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-touch-icon.png') }}">
            <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png') }}">
            <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png') }}"> --}}
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <meta name="description" content="Deskcall Client" />
            <meta name="author" content="dev-callcenter@pkp.co.id" />
        @show
        <title>@yield('title')</title>
        @section('css')
            <link href="{{ asset('assets/web/global/css/bootstrap-4.css') }}" rel="stylesheet">
            <link rel="stylesheet" href="{{ asset('assets/web/global/css/swiper.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/web/global/css/deskcall.client.css') }}"> 
            <link rel="stylesheet" href="{{ asset('assets/web/global/css/buttonPro.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/web/global/css/toastr.css ') }}">
            <link rel="stylesheet" href="{{ asset('assets/web/global/jQuery-Timepicker-Addon-master/dist/jquery-ui-timepicker-addon.css') }}">
            <link rel="stylesheet" href="{{asset('assets/web/global/jquery-ui-1.9.2/themes/base/minified/jquery-ui.min.css')}}">
        @show
        @section('script-top')
        <script src="{{ asset('assets/web/global/js/jquery-1.9.1.min.js') }}"></script>
        <script>
		
            var thetime = "{{ date('H:i:s') }}";
            var thetimerl = "{{ date('H:i:s') }}";
            
            // $(document).ready(function(){
            //     $("#error-login").hide();
            // });	

        </script> 
        
        <script src="{{ asset('assets/web/global/js/compare.datetime.beyond.js') }}"></script>

        <script src="{{asset('assets/web/global/jquery-ui-1.9.2/ui/minified/jquery-ui.min.js')}}"></script>
        <script src="{{ asset('assets/web/global/js/custom.beyond.js') }}"></script>
        <script src="{{ asset('assets/web/global/js/idle.beyond.js') }}"></script>
        <script src="{{ asset('assets/web/global/js/timer.beyond.js') }}"></script>

          {{-- @if($this->session->userdata('release_ID') || $getReleasesDb->num_rows() > 0)
            <script src="dist/assets/js/releases.beyond.js"></script>
        @endif --}}
        <script src="{{ asset('assets/web/global/js/timer.counter.beyond.js') }}"></script>
        <script src="{{ asset('assets/cms/js/toastr.js') }}"></script>
        @show
    </head>
    <body>
        @section('header')
            @include('website._base.header') 
        @show
        <div class="content">
            <div class="w-100">
                @yield('content')
            </div>
           
        </div>
      

        @section('footer')

        @show

        @section('script-bottom')
            <script src="{{ asset('assets/web/global/js/bootstrap4.js') }}"></script>
            <script type="text/javascript" src="{{asset('assets/web/global/jQuery-Timepicker-Addon-master/dist/jquery-ui-timepicker-addon.js')}}"></script>
            <script type="text/javascript" src="{{asset('assets/web/global/jQuery-Timepicker-Addon-master/dist/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>
            <script type="text/javascript" src="{{asset('assets/web/global/jQuery-Timepicker-Addon-master/dist/jquery-ui-sliderAccess.js')}}"></script>
            {{-- <script src="https://code.jquery.com/jquery-3.6.1.js"></script> --}}
            <script src="{{ asset('assets/web/global/js/jquery-1.9.1.min.js') }}"></script>
            <script src="{{ asset('assets/web/global/js/popper.js') }}"></script>
           
        @show
    </body>
</html>
