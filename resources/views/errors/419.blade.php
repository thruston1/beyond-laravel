@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('scriptTop')
    <script type="text/javascript">
        'use strict';
        window.location = "{{ redirect()->back()->getTargetUrl() }}";
    </script>
@endsection
@section('message')
    <a href="{{ redirect()->back()->getTargetUrl() }}">Page Expired, Click here to login page</a>
@endsection
