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
                        <li class="breadcrumb-item"><a href="<?php echo route('admin') ?>"><i class="fa fa-dashboard"></i> {{ __('general.home') }}</a></li>
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
                <div class="card-header">
                    <h3 class="card-title">{{ $formsTitle }}</h3>
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
                    @include(env('ADMIN_TEMPLATE').'._component.generate_forms')
                </div>
                @if($dataCompare->count() > 0)
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4">Source</div>
                                <div class="col-4">Compare</div>
                                <div class="col-4">Score</div>
                            </div>
                        </div>
                        @foreach($dataCompare as $list)
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4"><a href="{{ $list->image_source_full }}" rel="lightbox"><img style="width: 100%" src="{{ $list->image_source_full }}"/></a></div>
                                    <div class="col-4"><a href="{{ $list->image_compare_full }}" rel="lightbox"><img style="width: 100%" src="{{ $list->image_compare_full }}"/></a></div>
                                    <div class="col-4">{{ number_format($list->score, 2) }}%</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
                <!-- /.card-body -->

                <div class="card-footer">

                    @if($viewType == 'create')
                        <button type="submit" class="mb-2 mr-2 btn btn-success" title="@lang('general.save')">
                            <i class="fa fa-save"></i><span class=""> @lang('general.save')</span>
                        </button>
                    @elseif ($viewType == 'edit')
                        <button type="submit" class="mb-2 mr-2 btn btn-primary" title="@lang('general.update')">
                            <i class="fa fa-save"></i><span class=""> @lang('general.update')</span>
                        </button>
                    @elseif ($viewType == 'show')
                        @if (isset($permission['approve']) && $permission['approve'] == true && $data->status == 2)
                        <a href="<?php echo route('admin.' . $thisRoute . '.approve', $data->{$masterId}) ?>"
                           class="mb-2 mr-2 btn btn-primary" title="{{ __('general.approve') }}">
                            <i class="fa fa-check"></i><span class=""> {{ __('general.approve') }}</span>
                        </a>
                        @endif
                        @if (isset($permission['compare']) && $permission['compare'] == true)
                            <a href="<?php echo route('admin.' . $thisRoute . '.compare', $data->{$masterId}) ?>"
                               class="mb-2 mr-2 btn btn-primary" title="{{ __('general.compare') }}">
                                <i class="fa fa-copy"></i><span class=""> {{ __('general.compare') }}</span>
                            </a>
                        @endif
                        @if ($viewType == 'show' && $permission['edit'] == true)
                            <a href="<?php echo route('admin.' . $thisRoute . '.edit', $data->{$masterId}) ?>"
                               class="mb-2 mr-2 btn btn-primary" title="{{ __('general.edit') }}">
                                <i class="fa fa-pencil"></i><span class=""> {{ __('general.edit') }}</span>
                            </a>
                        @endif
                    @endif
                    <a href="<?php echo route('admin.' . $thisRoute . '.index') ?>" class="mb-2 mr-2 btn btn-warning"
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
@stop
