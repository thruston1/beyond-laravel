<!DOCTYPE html>
<html lang="en">
<head>
    @section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
<body class="hold-transition">
    <div class="row">
        <div class="col-6 login-page bg-white">
            <div class="login-box">
                @yield('content')
            </div>
            <!-- /.login-box -->
        </div>
        <div class="col-6 bg-login">

        </div>
    </div>


@section('script-bottom')
    <script src="{{ asset('assets/cms/js/app.js') }}"></script>
@show
</body>
</html>
