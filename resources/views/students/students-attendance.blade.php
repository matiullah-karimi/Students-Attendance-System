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
                            <option selected disabled>@lang('language.select-class')</option>
                            @foreach($teacher->classes as $class)
                                <option value="{{$class->id}}" id="classes" >{{$class->name}}</option>
                            @endforeach
                        </select>
                    </td>

                    <td id="teacher-subjects">
                        <select name="subject" class="form-control hidden-print">
                            <option>@lang('language.select-subject')</option>

                        </select>
                    </td>
                    <td>
                        <button class="btn btn-default" onclick="print()">Print</button>
                    </td>
                </tr>

                <tr>
                    <td>
                      <div class="input-group date" data-provide="datepicker-inline">
                            <input type="text" class="form-control datepicker" placeholder="Start Date" name="from" id="datepicker">
                            <div class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="input-group date" data-provide="datepicker-inline">
                            <input type="text" class="form-control datepicker" placeholder="End Date" id="datepicker1" name="to">
                            <div class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

            @else

            <table class="table table-responsive hidden-print">
                <tr>
                    <td>
                        <select name="class" class="form-control">
                            <option>@lang('language.select-class')</option>
                            @foreach($classes as $class)
                                <option value="{{$class->id}}" id="classes" >{{$class->name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <div id="teacher-subjects">
                            <select class="form-control">
                                <option>@lang('language.select-subject')</option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-default" onclick="print()">Print</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group date" data-provide="datepicker-inline">
                            <input type="text" class="form-control datepicker" placeholder="Start Date" name="from" id="datepicker">
                            <div class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="input-group date" data-provide="datepicker-inline">
                            <input type="text" class="form-control datepicker" placeholder="End Date" id="datepicker1" name="to">
                            <div class="input-group-addon">
                                <span class="fa fa-calendar"></span>
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
        $(document).ready(function(){
            $('#datepicker1').datepicker().on('changeDate', function(e){

                var classId = $('select[name=class]').val();
                var subjectId = $('select[name=subject]').val();

                var from_date = $('#datepicker').val();
                var to_date = $('#datepicker1').val();

                $.ajax({
                    url: '/students/date/filter/'+classId+'/'+subjectId,
                    data:{
                        from:from_date,
                        to:to_date
                    },
                    success:function(data){
                        console.log(data);
                        $('#students-atts').empty();
                        $('#students-atts').append(data);
                    }
                });

            });
        });
    </script>

@endsection