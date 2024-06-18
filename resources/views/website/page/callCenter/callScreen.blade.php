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
                                        Nama Customer
                                    </label>
                                </div>
                                <div class="vCust">
                                    <label class="vCustLabel">
                                        ((nama customer))
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
                                @foreach ($telp as $index => $item)
                                    <div class="lCust full">
                                        <label class="lCustLabel"> {{$item['label']}}</label>
                                    </div>
                                    <div class="vCust">
                                        <form action="javascript:;" onsubmit="return submitForm(this)">
                                            <input type="hidden" name="number" value="{{$item['telp']}}" id="numbers-{{$item['label']}}"/>
                                            <input type="hidden" name="kontrak" value="telp" id="filtered-{{$item['label']}}"/>
                                            <input id="number-{{$index}}" type="submit" class="btn buttonPro pink"
                                                name="agreement_no"
                                                value="CALL {{$item['label']}}"
                                                readonly="readonly"/>
                                        </form>
                                    </div>
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
                            <form action="javascript:;">
                                <div class="custRows px-3">
                                    <div class="hCustDet mb-3">
                                        <label>Collection</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="result-collection">Result</label>
                                        <select class="form-control" id="result-collection" onchange="changeResult()">
                                            <option disabled selected>Select Result</option>
                                            @foreach($result as $index => $item)
                                            <option value="{{$index}}">{{$item}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="button-submit-result" class="form-group" style="display: none">
                                        <button type="submit" class="btn btn-success">Submit Result</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('script-bottom')
    @parent

    <script>
        function changeResult(){
            $('#button-submit-result').show();
        }

        function submitForm(curr){
            let numberTelp = curr.number.value;
            let kontrakNo = curr.kontrak.value;
            let campaignId = '{{$campaign}}';

            $.ajax({	
			type: "POST",
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
			url: "{{route('callCenter.doCall')}}",
			data: {
                number : numberTelp,
                kontrak : kontrakNo,
                campaign : campaignId,
            },
			cache: false,
			success: function(result){
                if(result.success == 1){
                    toastr.success(result.message);
                }
                else{
                    toastr.error(result.message);
                }
			}
		});

        }
    </script>

@stop
