@extends('website._base.layout')

@section('title', 'Landing')

@section('script-top')
@parent


@stop

@section('content')
    <section class="container">
        <div class="card w-100">
            <div class="card-body">
                <h2>DESK COLLECTION</h2>
                <div id="container-chart" class="chart-dashboard"></div>
            </div>
        </div>
    </section>
@stop

@section('script-bottom')
    @parent
    <script src="{{ asset('assets/web/global/Highcharts-4.1.6/js/highcharts.js') }}"></script>
    <script src="{{ asset('assets/web/global/Highcharts-4.1.6/js/modules/exporting.js') }}"></script>
    <script>
        $(document).ready(function(){
            
            $('#container-chart').highcharts({
                
                exporting: {
                    enabled: false
                },
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Daily Load Performance'
                },
                subtitle: {
                    /*text: 'Source: WorldClimate.com'*/
                },
                xAxis: {
                    categories: [],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Task'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Final Load',
                    data: []
    
                }, {
                    name: 'Repetition Load',
                    data: []
    
                }, {
                    name: 'Regular Load',
                    data: []
    
                }],
                credits: {
                    enabled: false
                }
            });
    
        });	
    </script>

@stop
