@extends('layouts.app')
@section('content')


    <div class="container">

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
                    url:'filter3/'+id,
                    success:function(data){
                        console.log(data)
                        $('#students-atts').empty();
                        $('#students-atts').append(data);
                    }
                });
            });

        })

    </script>
@endsection