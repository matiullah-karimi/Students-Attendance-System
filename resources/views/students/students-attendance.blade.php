@extends('layouts.app')

@section('page_specific_styles')
    <link rel="stylesheet" href="{{asset('/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/custom.css')}}">
    @stop
@section('content')
    <div class="container">

        @if(Auth::user()->role != 1)
        <div class="row">
            <div class="col-md-5">

                <select name="class" class="form-control controlWidth">
                    <option selected disabled>Select Class</option>
                    @foreach($teacher->classes as $class)
                        <option value="{{$class->id}}" id="classes" >{{$class->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5" id="teacher-subjects">
                <select name="subject" class="form-control controlWidth">
                    <option>Select Subject</option>
                    @foreach($teacher->subjects as $subject)
                        <option value="{{$subject->id}}"> {{$subject->name}} </option>
                    @endforeach
                </select>
            </div>
        </div>

            @else

            <div class="row">
                <div class="col-md-5">

                    <select name="class" class="form-control controlWidth">
                        <option>Select Class</option>
                        @foreach($classes as $class)
                            <option value="{{$class->id}}" id="classes" >{{$class->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5" id="teacher-subjects"> </div>

            </div>


        @endif

            <div id="students-atts">

            </div>

        <a href="{{url('export2Excel')}}" class="btn btn-primary marginTop">Export to Excel</a>
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


@endsection