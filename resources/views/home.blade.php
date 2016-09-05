@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Attendance Dashboard</div>

                <div class="panel-body">
                    @if(Auth::user()->role != 1)

                        <form action="{{ url('storeResult') }}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <select name="class">
                                <option>Select Class</option>
                                @foreach($teacher->classes as $class)
                                    <option value="{{$class->id}}" id="classes" >{{$class->name}}</option>

                                @endforeach
                            </select>

                            <select name="subject">
                                <option>Select Subject</option>
                            @foreach($teacher->subjects as $subject)
                                <option value="{{$subject->id}}"> {{$subject->name}} </option>
                                    @endforeach
                            </select>
                            <div id="class-students">




                             </div>

                        </form>

                    @else
                    <a href="{{url('users')}}" class="btn btn-info">Teacher Entry</a>
                    <a href="{{url('subjects')}}" class="btn btn-info">Course Entry</a>
                    <a href="{{url('students')}}" class="btn btn-info">Students</a>
                    @endif

                    <a href="{{url('student/attendance')}}">View Students Attendance</a>

                </div>
            </div>
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
            });

        })

    </script>
@endsection
