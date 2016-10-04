@extends('layouts.master')

@section('page_specific_styles')
    <link rel="stylesheet" href="{{asset('/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/custom.css')}}">
    @stop
@section('content')
    <div class="container">

        @if(Auth::user()->role != 1)
            <table class="table table-responsive hidden-print">
                <tr>
                    <td>
                        <select name="class" class="form-control hidden-print" >
                            <option selected disabled>Select Class</option>
                            @foreach($teacher->classes as $class)
                                <option value="{{$class->id}}" id="classes" >{{$class->name}}</option>
                            @endforeach
                        </select>
                    </td>

                    <td>
                        <select name="subject" class="form-control hidden-print">
                            <option>Select Subject</option>

                        </select>
                    </td>
                    <td>
                        <button class="btn btn-default" onclick="print()">Print</button>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="input-group date">
                            <div class="input-group-addon">From</div>
                            <input type="text" class="form-control pull-right datepicker" id="datepicker" name="from">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="input-group date">
                            <div class="input-group-addon">To</div>
                            <input type="text" class="form-control pull-right datepicker" id="datepicker1" name="to">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

            @else

            <table class="table table-responsive">
                <tr>
                    <td>
                        <select name="class" class="form-control">
                            <option>Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{$class->id}}" id="classes" >{{$class->name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <div id="teacher-subjects">
                            <select class="form-control">
                                <option>Select Subject</option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-default" onclick="print()">Print</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group date">
                            <div class="input-group-addon">From</div>
                            <input type="text" class="form-control pull-right datepicker" id="datepicker" name="from">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="input-group date">
                            <div class="input-group-addon">To</div>
                            <input type="text" class="form-control pull-right datepicker" id="datepicker1" name="to">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

        @endif

            <div id="students-atts">
            </div>
    </div>

@endsection

@section('page_specific_scripts')
    <script>

        $(function(){

            $('select[name="class"]').change(function(){
                var id = $('select[name=class]').val();
                $.ajax({
                    url:'/subjects/filterSubject/'+id,
                    success:function(data){
                        console.log(data)
                        $('#teacher-subjects').empty();
                        $('#teacher-subjects').append(data);
                    }
                });
            });
        });

        </script>
        <script>
            $(function(){
                $('select[name="subject"]').change(function(){
                    console.log("worked");

                });
            });

        </script>

    <script>
        function filterSubjects(){
            var classId = $('select[name=class]').val();
            var subjectId = $('select[name=subject]').val();
            console.log(subjectId);
            $.ajax({
                url:'filter3/'+classId,
                data:{subId: subjectId},
                success:function(data){
                    console.log(data)
                    $('#students-atts').empty();
                    $('#students-atts').append(data);
                }
            });
        }
    </script>

    <script>
        $(function(){
            $('#datepicker1').change(function(){
                console.log("date selected");
            });
        });
    </script>


@endsection