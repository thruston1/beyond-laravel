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

@section('script-top')
    @parent
    <script>
        CKEDITOR_BASEPATH = '/assets/cms/js/ckeditor/';
    </script>
@stop

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $thisLabel }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo route('admin') ?>"><i class="fas fa-dashboard"></i> {{ __('general.home') }}</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo route('admin.' . $thisRoute . '.index') ?>"> {{ __('general.title_home', ['field' => $thisLabel]) }}</a></li>
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
                <div class="card-header bg-white">
                    <h3>{{ $formsTitle }}</h3>
                </div>
                <!-- /.card-header -->

                @if($viewType == 'create')
                    {{ Form::open(['route' => ['admin.' . $thisRoute . '.store'], 'files' => true, 'id'=>'form', 'role' => 'form'])  }}
                @elseif($viewType == 'edit')
                    {{ Form::open(['route' => ['admin.' . $thisRoute . '.update', $data->{$masterId}], 'method' => 'PUT', 'files' => true, 'id'=>'form', 'role' => 'form'])  }}
                @else
                    {{ Form::open(['id'=>'form', 'role' => 'form'])  }}
                @endif

                <div class="card-body">
                    <div class="row">
                        @include(env('ADMIN_TEMPLATE').'._component.generate_forms')
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer justify-content-end d-flex">
                    <a href="<?php echo route('admin.' . $thisRoute . '.index') ?>" class="mb-2 mr-2 btn btn-outline-primary
                        title="{{ __('general.cancel') }}">
                         <i class="fas fa-arrow-circle-o-left"></i><span class=""> {{ __('general.cancel') }}</span>
                     </a>
                    @if($viewType == 'create')
                        <button type="submit" class="mb-2 mr-2 btn btn-primary" title="@lang('general.save')">
                            <i class="fas fa-save"></i><span class=""> @lang('general.save')</span>
                        </button>
                    @elseif ($viewType == 'edit')
                        <button type="submit" class="mb-2 mr-2 btn btn-primary" title="@lang('general.update')">
                            <i class="fas fa-save"></i><span class=""> @lang('general.update')</span>
                        </button>
                    @elseif ($viewType == 'show' && $permission['edit'] == true)
                        <a href="<?php echo route('admin.' . $thisRoute . '.edit', $data->{$masterId}) ?>"
                           class="mb-2 mr-2 btn btn-primary" title="{{ __('general.edit') }}">
                            <i class="fas fa-pencil"></i><span class=""> {{ __('general.edit') }}</span>
                        </a>
                    @endif


                </div>

                {{ Form::close() }}

            </div>
        </div>
    </section>

@stop

@section('script-bottom')
    @parent
    @include(env('ADMIN_TEMPLATE').'._component.generate_forms_script')
    <script>
        function changePrice(curr){
            let val = $(curr).val();
            let saleVal = parseInt(val) * parseFloat(30/100);
            let totalVal = saleVal + parseInt(val);
            $('#price_sale').val(totalVal);
        }
    </script>
@stop
