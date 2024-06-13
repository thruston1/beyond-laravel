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
            <div  class="card">
                <div class="card-body">
                    <?php if(count($mastercampaign) > 0 ):?>
                    <select id="type_campaign" name="type_campaign" data-plugin-selecttwo="" class="form-control populate select2-offscreen" tabindex="-1" title="">
                        <optgroup label="CAMPAIGN">
                            <option value="0">- SELECT TYPE CAMPAIGN -</option>
                            @foreach($mastercampaign as $mt)
                                <option value="{{$mt->campaignName}}">{{$mt->campaignName}}</option>
                            @endforeach
                        </optgroup>
                    </select>
                    <?php endif;?>
                </div>
            </div>
            <div id="data-table" style="display: none">
                <h4>{{ __('general.title_home', ['field' => $thisLabel]) }}</h4>

                <div class="mb-3">
                    <a href="javascript:;" id="submit_bucket" class="btn btn-success">@lang('general.submit_bucket')</a>
                </div>
            <div class="card">
                <div class="card-body overflow-auto">
                    <table class="table table-bordered table-striped" id="data1">
                    </table>
                </div>
            </div>
            <h4>@lang('general.data_info_task')</h4>
            <div class="card">
            <div class="card-body overflow-auto">
                <table class="table table-bordered table-striped" id="data2">
                </table>
            </div>
            </div>
            
        </div>

        </div>
    </section>
@stop

@section('script-bottom')
    @parent
    <script type="text/javascript">
        'use strict';
        let table;
        let table2;
        var campaignValue = '';
        function getTable(camp)
        {
            
        table = $('#data1').DataTable({
            serverSide: true,
            processing: true,
            // pageLength: 25,
            // lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            ajax: '{{ route('admin.' . $thisRoute . '.dataTable') }}?campaign='+camp+'',
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

        table2 = $('#data2').DataTable({
            serverSide: true,
            processing: true,
            // pageLength: 25,
            // lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            ajax: '{{ route('admin.dataInfoTask.dataTable') }}?status=1',
            aaSorting: [ {!! isset($listAttribute['aaSorting']) ? $listAttribute['aaSorting'] : "[0,'desc']" !!}],
            columns: [
                    @foreach($passingDataInfo as $fieldName => $fieldData)
                {data: '{{ $fieldName }}', title: "{{ __($fieldData['lang']) }}" <?php echo strlen($fieldData['custom']) > 0 ? $fieldData['custom'] : ''; ?> },
                @endforeach
            ],
            fnDrawCallback: function( oSettings ) {
                // $('a[data-rel^=lightcase]').lightcase();
            }
        });
        }


        
        $( document ).ready(function() {
        // Handler for .ready() called.
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

        $('#type_campaign').change(function(){
            let val = $('#type_campaign').val();
            campaignValue = val;
            getTable(val);
            $('#data-table').show();
        })

        $('#submit_bucket').click(function()
        {   

            $.ajax({
                   type:"POST",
                   headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                   url: '{{ route('admin.' . $thisRoute . '.submitBucket') }}',
                   data:{
                       campaign :campaignValue
                   },
                   success:function(result){
                        if(result.success == 1){
                            toastr.success(result.message);
                        }
                        else{
                            toastr.error(result.message);
                        }
                        console.log(campaignValue);
                        table.draw();
                        table2.draw();
                   },
                   error:function(){
                       alert('error; ' + eval(error));
                   }
               })

            
            
        })

    </script>
@stop
