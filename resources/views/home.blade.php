@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <?php
            $data = array();
            $counter = 0;
            ?>
            @foreach($classes as $class)
                    <?php
                    $data[$counter]['name'] = $class->name;
                    $data[$counter]['total'] = $class->students->count();
                    $counter++;
                    ?>
            @endforeach
                <?php $chart_data = json_encode($data);?>

                @if(Auth::user()->role != 1)

                        <form action="{{ url('storeResult') }}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <select name="class" class="form-control controlWidth">
                                <option>Select Class</option>
                                @foreach($teacher->classes as $class)
                                    <option value="{{$class->id}}" id="classes" >{{$class->name}}</option>

                                @endforeach
                            </select>

                            <div id="teacher-subject" class="marginTop"></div>

                            <div id="class-students"></div>

                        </form>

                    @else

                    <div class="row">

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text"><a href="{{url('students')}}">Students</a></span>
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
                                    <span class="info-box-text"><a href="{{url('users')}}">Teachers</a></span>
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
                                    <span class="info-box-text"><a href="{{url('classes')}}">Classes</a></span>
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
                                    <span class="info-box-text"><a href="{{url('subjects')}}">Subjects</a></span>
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
                </style>

                <!-- Resources -->
                <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
                <script src="https://www.amcharts.com/lib/3/funnel.js"></script>
                <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
                <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
                <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

                <!-- Chart code -->
                <script>
                    var chart = AmCharts.makeChart( "chartdiv", {
                        "type": "funnel",
                        "theme": "light",
                        "dataProvider": '{!! $chart_data !!}}',
                        "balloon": {
                            "fixedPosition": true
                        },
                        "valueField": "total",
                        "titleField": "name",
                        "marginRight": 240,
                        "marginLeft": 50,
                        "startX": -500,
                        "depth3D": 100,
                        "angle": 40,
                        "outlineAlpha": 1,
                        "outlineColor": "#FFFFFF",
                        "outlineThickness": 2,
                        "labelPosition": "right",
                        "balloonText": "[[name]]: [[total]]n[[description]]",
                        "export": {
                            "enabled": true
                        }
                    } );
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
