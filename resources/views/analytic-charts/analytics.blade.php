@extends('layouts.master')
@section('content')


    <style>
        .anCharts {
            width: 100%;
            height: 500px;
            font-size:11px;
        }
        .amcharts-export-menu-top-right {
            top: 10px;
            right: 0;
        }
        #browsers{
            width: 100%;
            height: 500px;
            font-size:11px;
        }
    </style>

    <!-- Resources -->
    <script src="{{asset('js/amcharts.js')}}"></script>
    <script src="{{asset('js/serial.js')}}"></script>
    <script src="{{asset('js/export.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/export.css')}}" type="text/css" media="all" />
    <script src="{{asset('js/light.js')}}"></script>
    <script src="{{asset('js/dataloader.min.js')}}"></script>
    <script src="{{asset('/amcharts/amcharts.js')}}"></script>
    <script src="{{asset('/amcharts/serial.js')}}"></script>
    <script src="{{asset('/amcharts/pie.js')}}"></script>
    <script src="{{asset('/amcharts/radar.js')}}"></script>
    <script src="{{asset('/amcharts/xy.js')}}"></script>
    <script src="{{asset('/amcharts/gauge.js')}}"></script>
    <script src="{{asset('/amcharts/funnel.js')}}"></script>
    <script src="{{asset('/amcharts/themes/light.js')}}"></script>
    <script src="{{asset('/amcharts/themes/none.js')}}"></script>
    <script src="{{asset('/amcharts/plugins/export/export.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{asset('/amcharts/plugins/export/export.css')}}" type="text/css" media="all" />



    <div class="container">
        <div class="row">
            @foreach($analyticsData as $item)
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total of Sessions</span>
                        <span class="info-box-number">{{$item[0]}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-eye"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total of Page views</span>
                        <span class="info-box-number">{{$item[1]}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            @endforeach

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Most Viewed Pages</b>
                    </div>
                    <div class="panel-body">
                        <div id="chartdiv" class="anCharts"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Most Used Browsers</b>
                    </div>
                    <div class="panel-body">
                        <div id="browsers"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Most Viewed Unique Pages</b>
                    </div>
                    <div class="panel-body">
                        <div id="pageViews" class="anCharts"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Sessions By Country</b>
                    </div>
                    <div class="panel-body">
                        <div id="sbcountry" class="anCharts"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Sessions By Operating Systems</b>
                    </div>
                    <div class="panel-body">
                        <div id="operatingSys" class="anCharts"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Mobile Traffics</b>
                    </div>
                    <div class="panel-body">
                        <div id="mobileTraffics" class="anCharts"></div>
                    </div>
                </div>

            </div>

        </div>
    </div>


    <!-- Donut Chart code -->

    <script>
        var chart = AmCharts.makeChart( "browsers", {
            "type": "pie",
            "theme": "light",
            "dataLoader":{
                "url": '{{url('/browsers')}}'
            } ,
            "titleField": "country",
            "valueField": "visits",
            "labelRadius": 5,

            "radius": "42%",
            "innerRadius": "60%",
            "labelText": "[[title]]",
            "export": {
                "enabled": true
            }
        } );
    </script>

    <!-- -->
    <script>
        var chart = AmCharts.makeChart("chartdiv", {
            "theme": "light",
            "type": "serial",
            "startDuration": 2,
            "dataLoader":{
                "url": '{{url('/mostVisitedPages')}}'
            },
            "valueAxes": [{
                "position": "left",
                "axisAlpha":0,
                "gridAlpha":0
            }],
            "graphs": [{
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "colorField": "color",
                "fillAlphas": 0.85,
                "lineAlpha": 0.1,
                "type": "column",
                "topRadius":1,
                "valueField": "visits"
            }],
            "depth3D": 40,
            "angle": 30,
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "country",
            "categoryAxis": {
                "gridPosition": "start",
                "axisAlpha":0,
                "gridAlpha":0

            },
            "export": {
                "enabled": true
            }

        }, 0);
    </script>


    <script>
        function addChart(url,title,selector){

            var chart= AmCharts.makeChart(selector, {
                "type": "serial",
                "theme": "light",
                "marginRight": 70,
                "dataLoader": {
                    "url": url
                }
                ,
                "valueAxes": [{
                    "axisAlpha": 0,
                    "position": "left",
                    "title": title
                }],
                "startDuration": 1,
                "graphs": [{
                    "balloonText": "<b>[[category]]: [[value]]</b>",
                    "fillColorsField": "color",
                    "fillAlphas": 0.9,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "visits"
                }],
                "chartCursor": {
                    "categoryBalloonEnabled": false,
                    "cursorAlpha": 0,
                    "zoomable": false
                },
                "categoryField": "country",
                "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 45
                },
                "export": {
                    "enabled": true
                }

            });

            return chart;
        }


        {{--addChart('{{ url('/browsers') }}', 'Top Browsers', 'browsers');--}}
        {{--addChart('{{ url('/mostVisitedPages') }}', 'Most Visited Pages', 'chartdiv');--}}
        addChart('{{ url('/pageViews') }}', 'Most Visited Pages (Session scope)', 'pageViews');
        addChart('{{ url('/sessionByCountry') }}', 'Sessions by Country', 'sbcountry');
        {{--addChart('{{ url('/operatingSystems') }}', 'Operating Systems', 'operatingSys');--}}
        {{--addChart('{{ url('/mobileTraffics') }}', 'Mobile Traffics', 'mobileTraffics');--}}

    </script>

    <!-- Chart code -->
    <script>
        var chart = AmCharts.makeChart( "mobileTraffics", {
            "type": "pie",
            "theme": "light",
            "dataLoader": {
                "url": '{{url('/mobileTraffics')}}'
            },
            "valueField": "value",
            "titleField": "country",
            "outlineAlpha": 0.4,
            "depth3D": 15,
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "angle": 30,
            "export": {
                "enabled": true
            }
        } );
    </script>

    <!-- Chart code -->
    <script>
        var chart = AmCharts.makeChart( "operatingSys", {
            "type": "funnel",
            "theme": "light",
            "dataLoader": {
                "url": '{{url('/operatingSystems')}}'
            },
            "balloon": {
                "fixedPosition": true
            },
            "valueField": "value",
            "titleField": "title",
            "marginRight": 240,
            "marginLeft": 50,
            "startX": -500,
            "rotate": true,
            "labelPosition": "right",
            "balloonText": "[[title]]: [[value]]n[[description]]",
            "export": {
                "enabled": true
            }
        } );
    </script>

    <script>
        var chart = AmCharts.makeChart("chartdiv", {
            "type": "serial",
            "theme": "light",
            "legend": {
                "horizontalGap": 10,
                "maxColumns": 1,
                "position": "right",
                "useGraphSettings": true,
                "markerSize": 10
            },
            "dataProvider": [{
                "year": 2003,
                "europe": 2.5,
                "namerica": 2.5,
                "asia": 2.1,
                "lamerica": 0.3,
                "meast": 0.2,
                "africa": 0.1
            }, {
                "year": 2004,
                "europe": 2.6,
                "namerica": 2.7,
                "asia": 2.2,
                "lamerica": 0.3,
                "meast": 0.3,
                "africa": 0.1
            }, {
                "year": 2005,
                "europe": 2.8,
                "namerica": 2.9,
                "asia": 2.4,
                "lamerica": 0.3,
                "meast": 0.3,
                "africa": 0.1
            }],
            "valueAxes": [{
                "stackType": "regular",
                "axisAlpha": 0.3,
                "gridAlpha": 0
            }],
            "graphs": [{
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "Europe",
                "type": "column",
                "color": "#000000",
                "valueField": "europe"
            }, {
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "North America",
                "type": "column",
                "color": "#000000",
                "valueField": "namerica"
            }, {
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "Asia-Pacific",
                "type": "column",
                "color": "#000000",
                "valueField": "asia"
            }, {
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "Latin America",
                "type": "column",
                "color": "#000000",
                "valueField": "lamerica"
            }, {
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "Middle-East",
                "type": "column",
                "color": "#000000",
                "valueField": "meast"
            }, {
                "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                "fillAlphas": 0.8,
                "labelText": "[[value]]",
                "lineAlpha": 0.3,
                "title": "Africa",
                "type": "column",
                "color": "#000000",
                "valueField": "africa"
            }],
            "categoryField": "year",
            "categoryAxis": {
                "gridPosition": "start",
                "axisAlpha": 0,
                "gridAlpha": 0,
                "position": "left"
            },
            "export": {
                "enabled": true
            }

        });
    </script>

    @endsection