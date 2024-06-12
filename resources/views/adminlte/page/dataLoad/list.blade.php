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
                <!-- /.card-header -->
                <div class="card-body">
                    <?php if(count($mastercampaign) > 0 ):?>
                    <select id="type_campaign" name="type_campaign" data-plugin-selecttwo="" class="form-control populate select2-offscreen" tabindex="-1" title="">
                        <optgroup label="CAMPAIGN">
                            <option value="0">- SELECT TYPE CAMPAIGN -</option>
                            @foreach($mastercampaign as $mt)
                                @php
                                    $cek="";
                                    foreach ($listcampaign as $lc) {
                                        if($mt->campaignName == $lc->campaignName){	
                                            $cek='ada';

                                        }
                                    }
                                    
                                @endphp
                                @if($cek=='ada')
                                <option value="{{$mt->campaignName}}">{{$mt->campaignName}}</option>
                                @endif
                            @endforeach
                        </optgroup>
                    </select>
                <?php endif;?>
                </div>  
                <!-- /.card-body -->
            </div>
            <div id="uploadcampaigndata"></div>
        </div>
    </section>
@stop

@section('script-bottom')
    @parent
    <script type="text/javascript">
        'use strict';
        let table;
        // table = $('#data1').DataTable({
        //     serverSide: true,
        //     processing: true,
        //     // pageLength: 25,
        //     // lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        //     ajax: '{{ route('admin.' . $thisRoute . '.dataTable') }}',
        //     aaSorting: [ {!! isset($listAttribute['aaSorting']) ? $listAttribute['aaSorting'] : "[0,'desc']" !!}],
        //     columns: [
        //             @foreach($passing as $fieldName => $fieldData)
        //         {data: '{{ $fieldName }}', title: "{{ __($fieldData['lang']) }}" <?php echo strlen($fieldData['custom']) > 0 ? $fieldData['custom'] : ''; ?> },
        //         @endforeach
        //     ],
        //     fnDrawCallback: function( oSettings ) {
        //         // $('a[data-rel^=lightcase]').lightcase();
        //     }
        // });

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
			
            if($('#type_campaign').val()!='0'){
               $.ajax({
                   type:"POST",
                   headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                   url: '{{ route('admin.' . $thisRoute . '.ajaxData') }}',
                   data:{
                       type :$('#type_campaign').val()
                   },
                   success:function(n){
                    console.log(n);
                       $("#uploadcampaigndata").fadeIn("slow").html(n).promise().done(function() {
                                           
                        })
                   },
                   error:function(){
                       alert('error; ' + eval(error));
                   }
               })
           }else{
               $("#uploadcampaigndata").fadeIn("slow").html('').promise().done(function() {
                                           
                        })
           }
        })

    </script>
@stop
