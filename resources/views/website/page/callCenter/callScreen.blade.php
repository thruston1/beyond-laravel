@extends('website._base.layout')

@section('title', 'Beyond Laravel')


@section('content')
    <section class="container">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex">
                    @include('website.page.callCenter.customerDetails')
                </div>
            </div>
        </div>
    </section>
@stop

@section('script-bottom')
    @parent

@stop
