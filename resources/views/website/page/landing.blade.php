@extends('website._base.layout')

@section('title', 'Landing')


@section('content')
    <section class="container">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="mx-auto">
                        <a href="{{route('admin')}}" class="btn btn-primary">
                            To CMS
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('script-bottom')
    @parent

@stop
