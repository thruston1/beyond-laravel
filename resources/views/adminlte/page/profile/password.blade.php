<?php
switch ($viewType) {
    case 'create': $printCard = 'card-success'; break;
    case 'edit': $printCard = 'card-primary'; break;
    default: $printCard = 'card-info'; break;
}
if ($viewType == 'show') {
    $addAttribute = [
        'disabled' => true
    ];
}
else {
    $addAttribute = [
    ];
}
?>
@extends(env('ADMIN_TEMPLATE').'._base.layout')

@section('title', $formsTitle)

@section('css')
    @parent
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $formsTitle }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo route('admin') ?>"><i class="fa fa-dashboard"></i> {{ __('general.home') }}</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo route('admin.' . $thisRoute) ?>"> {{ __('general.title_home', ['field' => $thisLabel]) }}</a></li>
                        <li class="breadcrumb-item active">{{ $formsTitle }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card {!! $printCard !!}">
                <div class="card-header">
                    <h3 class="card-title">{{ $formsTitle }}</h3>
                </div>
                <!-- /.card-header -->

                {{ Form::open(['route' => ['admin.postPassword'], 'method' => 'POST', 'files' => true, 'id'=>'form', 'role' => 'form'])  }}

                <div class="card-body">
                    @include(env('ADMIN_TEMPLATE').'._component.generate_forms')
                </div>
                <!-- /.card-body -->

                <div class="card-footer">

                    <button type="submit" class="mb-2 mr-2 btn btn-primary" title="@lang('general.update')">
                        <i class="fa fa-save"></i><span class=""> @lang('general.update')</span>
                    </button>
                    <a href="<?php echo route('admin.profile') ?>" class="mb-2 mr-2 btn btn-warning"
                       title="{{ __('general.back') }}">
                        <i class="fa fa-arrow-circle-o-left"></i><span class=""> {{ __('general.back') }}</span>
                    </a>

                </div>

                {{ Form::close() }}

            </div>
        </div>
    </section>

@stop

@section('script-bottom')
    @parent
    @include(env('ADMIN_TEMPLATE').'._component.generate_forms_script')
    <script type="text/javascript">
        'use strict';
        $(document).ready(function() {
            $('.checkThis').click(function() {
                var name = $(this).data('name');
                if ($(this).is(':checked')) {
                    $('.' + name).prop( "checked", true );
                }
                else {
                    $('#super_admin').prop( "checked", false );
                    $('.' + name).prop( "checked", false );
                }
            });
        });
        @if ($viewType == 'show')
        $('.checkThis').attr('disabled', true);
        $('#branch').attr('disabled', true);
        @endif
    </script>
@stop
