@extends('layouts.master')
@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <?php
            $data = array();
            $counter = 0;
            foreach($classes as $class)
            {
                $data[$counter]['country'] = $class->name;
                $data[$counter]['visits'] = $class->students->count();
                $data[$counter]['color'] = "#FF0F00";
                $counter++;
            }
            header( 'Content-Type: application/json' );

            ?>

                @if(Auth::user()->role != 1)

                        <form action="{{ url('storeResult') }}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <div class="row">
                                <div class="col-md-4">
                                    <select name="class" class="form-control">
                                        <option>@lang('language.select-class')</option>
                                        @foreach($teacher->classes as $class)
                                            <option value="{{$class->id}}" id="classes" >{{$class->name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div id="teacher-subject"></div>
                                </div>
                            </div>

                            <div id="class-students" class="marginTop"></div>

                        </form>

                    @else

                    <div class="row">

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text"><a href="{{url('students')}}">@lang('language.students')</a></span>
                                    <span class="info-box-number">{{count($students)}}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text"><a href="{{url('users')}}">@lang('language.teachers')</a></span>
                                    <span class="info-box-number">{{count($teachers)}}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-orange"><i class="fa fa-th"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text"><a href="{{url('classes')}}">@lang('language.classes')</a></span>
                                    <span class="info-box-number">{{count($classes)}}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fa fa-book"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text"><a href="{{url('subjects')}}">@lang('language.subjects')</a></span>
                                    <span class="info-box-number">{{count($subjects)}}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                    </div>


                    {{--Graphs--}}


                            <!-- Styles -->
                    <style>
                        #chartdiv {
                            width: 100%;
                            height: 500px;
                        }
                        .amcharts-export-menu-top-right {
                            top: 10px;
                            right: 0;
                        }
                    </style>

                    <!-- Resources -->
                    <script src="{{asset('js/amcharts.js')}}"></script>
                    <script src="{{asset('js/serial.js')}}"></script>
                    <script src="{{asset('js/export.min.js')}}"></script>
                    <link rel="stylesheet" href="{{asset('css/export.css')}}" type="text/css" media="all" />
                    <script src="{{asset('js/light.js')}}"></script>
                    <script src="{{asset('js/dataloader.min.js')}}"></script>

                    <!-- Chart code -->
                    <script>

                        var chart = AmCharts.makeChart("chartdiv", {
                            "type": "serial",
                            "theme": "light",
                            "marginRight": 70,
                            "dataLoader": {
                                "url": '{{url('showChart')}}'
                            }
                            ,
                            "valueAxes": [{
                                "axisAlpha": 0,
                                "position": "left",
                                "title": "{{trans('language.number-of-students')}}"
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
                    </script>

                    <!-- HTML -->
                    <div id="chartdiv"></div>


                    {{--End Graph--}}

                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

        </div>
    </div>
</div>
@endsection

@section('page_specific_scripts')
    <script>

        $(function(){

            $('select[name="class"]').change(function(){
                var id = $('select[name=class]').val();
                $.ajax({
                    url:'students/filter2/'+id,
                    success:function(data){
                        console.log(data)
                        $('#class-students').empty();
                        $('#class-students').append(data);
                    }
                });

                $.ajax({
                    url:'subjects/filterSubject/'+id,
                    success:function(data){
                        console.log(data)
                        $('#teacher-subject').empty();
                        $('#teacher-subject').append(data);
                    }
                });
            });

        })

    </script>
@endsection
