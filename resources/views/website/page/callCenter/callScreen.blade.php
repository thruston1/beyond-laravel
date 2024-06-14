@extends('website._base.layout')

@section('title', 'Beyond Laravel')

@section('css')
@parent
<link rel="stylesheet" type="text/css" href="{{asset('assets/global/DataTables-1.10.7/media/css/jquery.dataTables.min.css')}}">
@stop

@section('scrip-top')
@parent
<script src="{{asset('assets/global/js/validation.beyond.js')}}"></script>
<script src="{{asset('assets/global/js/transactions.beyond.js')}}"></script>
<script type="text/javascript" charset="utf8" src="{{asset('assets/global/DataTables-1.10.7/media/js/jquery.dataTables.min.js')}}"></script>
@stop



@section('content')
    <section class="container">
        <div class="card w-100">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="">
                            <div class="hCustDet w-100">
                                <label>Customer Info</label>
                                {{-- <div class="head-image-callback"></div> --}}
                            </div>
                            <div class="custRows border-bottom w-100">
                                <div class="lCust">
                                    <label class="lCustLabel">
                                        Description
                                    </label>
                                </div>
                                <div class="vCust">
                                    <label class="vCustLabel">
                                        Value Description
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="">
                            <div class="hCustDet w-100">
                                <label>Validation</label>
                            </div>
                            <div class="custRows">
                                @foreach ($telp as $item)
                                    <div class="lCust full">
                                        <label class="lCustLabel"> {{$item['label']}} <?php // echo ${'namePhone'.$no}?></label>
                                    </div>
                                    <div class="vCust">
                                        <input type="hidden" value="{{$item['telp']}}" id="numbers-{{$item['label']}}"/>
                                        <input type="hidden" value="<?php // echo(${'filtered'.$no}); ?>" id="filtered-{{$item['label']}}"/>
                                        <input id="number-1" type="button" class="btn buttonPro pink "
                                            name="agreement_no"
                                            value="CALL 1234"
                                            readonly="readonly"/>
                                    </div>
                        
                                    {{-- <div class="vCustSel_validation">
                                        <select id="state-0" class="selCustDet margin-from-right">
                                            <option value=""> Select Value </option>
                                        </select>
                                    </div>   --}}
                                @endforeach
                               
                            </div>
                        
                        
                            <div class="hCustDet from-top w-100">
                                <label>INFORMATION</label>
                            </div>
        
                            <div class="custRows">
                                <div class="lCust full">
                                    <label><b>TASK START TIME : </b> {{ date('Y-m-d H:i:s') }} </label>
                        
                                </div>
                            </div>
                            <div class="custRows">
                                <div class="lCust full d-flex">
                                    <div class="color-legend single"></div>
                                    <div class="label-legend">
                                        <label>SINGLE NUMBER</label>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="custRows">
                                <div class="lCust full d-flex">
                                    <div class="color-legend same"></div>
                                    <div class="label-legend">
                                        <label>SIMILIAR NUMBER</label>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="custRows">
                                <div class="lCust full d-flex">
                                    <div class="color-legend invalid"></div>
                                    <div class="label-legend">
                                        <label>INVALID NUMBER</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="">
                            <div class="custRows">
                                <div class="hCustDet">
                                    <label>Collection</label>
                                </div>
                                {{-- @include('website.page.callCenter.question') --}}
                                
                                <div class="hCustDet from-top">
                                    <label>Today Performance</label>
                                </div>
                        
                                <div class="custRows">
                                    <div class="lCust full">
                                        <div class="t_performance">
                                            <span class="summary-param">CALLED TODAY : </span><span class="count-summary-value">0</span>
                                        </div>
                                        <div class="c_performance">
                                            <span class="summary-param"> Nama parameter : </span><span class="count-summary-value">0</span>
                                            <span class="count-percent">0</span>
                                            <b class="count-percent"> (0%)</b>
                                        </div>	
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('script-bottom')
    @parent

@stop
