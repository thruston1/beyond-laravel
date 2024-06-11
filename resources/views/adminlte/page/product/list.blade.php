<?php
$categoryId = app()->request->get('category_id');

$params = [];
if ($categoryId) {
    $params['category_id'] = $categoryId;
}
?>

@extends(env('ADMIN_TEMPLATE').'._base.layout')

@section('title', __('general.title_home', ['field' => $thisLabel]))

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
                    <h1>{{ __('general.title_home', ['field' => $thisLabel]) }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo route('admin') ?>"><i class="fas fa-dashboard"></i> {{ __('general.home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('general.title_home', ['field' => $thisLabel]) }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    @if ($permission['create'])
                    <a href="<?php echo route('admin.' . $thisRoute . '.create') ?>" class="mb-2 mr-2 btn btn-success"
                       title="@lang('general.create')">
                        <i class="fas fa-plus-square"></i> @lang('general.create')
                    </a>
                    @endif
                    @if ($permission['list'])
                    {{-- <a href="<?php echo route('admin.' . $thisRoute . '.index') ?>?export=1" class="mb-2 mr-2 btn btn-success"
                        title="@lang('general.create')">
                        <i class="fas fa-plus-square"></i> @lang('general.export')
                    </a> --}}
                    @endif
                    <form method="get">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="form-group mb-0">
                                    <label for="category">Category</label>
                                    {{ Form::select('category_id', $listSet['category_id'], old('category_id', $categoryId), ['id' => 'category', 'class' => 'form-control select2', 'autocomplete' => 'off', 'required' => true]) }}
                                </div>
                            </div>
                            <div class="col-sm-4 ml-auto d-flex">
                                <button type="submit" class="btn btn-success ml-auto mt-auto mr-2">
                                    Filter
                                </button>
                                <button class="btn btn-success mt-auto" type="submit" name="export" value="1">
                                    @lang('general.export')
                                </button>
                            </div>
                        </div>


                    </form>

                </div>
                <!-- /.card-header -->
                <div class="card-body overflow-auto">
                    <table class="table table-bordered table-striped" id="data1">
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
@stop

@section('script-bottom')
    @parent
    <script type="text/javascript">
        'use strict';
        let table;
        table = $('#data1').DataTable({
            serverSide: true,
            processing: true,
            // pageLength: 25,
            // lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            ajax: '{{ route('admin.' . $thisRoute . '.dataTable') }}{!! '?' . http_build_query($params) !!}',
            aaSorting: [ {!! isset($listAttribute['aaSorting']) ? $listAttribute['aaSorting'] : "[0,'desc']" !!}],
            columns: [
                    @foreach($passing as $fieldName => $fieldData)
                {data: '{{ $fieldName }}', title: "{{ __($fieldData['lang']) }}" <?php echo strlen($fieldData['custom']) > 0 ? $fieldData['custom'] : ''; ?> },
                @endforeach
            ],
            fnDrawCallback: function( oSettings ) {
                // $('a[data-rel^=lightcase]').lightcase();
            }
        });

        function actionData(link, method) {

            if(confirm('{{ __('general.ask_delete') }}')) {
                let linkSplit = link.split('/');
                let url = '';
                for(let i=3; i<linkSplit.length; i++) {
                    url += '/'+linkSplit[i];
                }

                $.ajax({
                    url: url,
                    type: method,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(result) {

                    },
                    complete: function(){
                        table.ajax.reload();
                    }
                });
            }
        }

    </script>
@stop
