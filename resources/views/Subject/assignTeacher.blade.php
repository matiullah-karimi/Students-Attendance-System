@extends('layouts.master')
@section('content')

    <div class="container">


        <h2>{{$subject->name}}</h2>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
            <li><a data-toggle="tab" href="#menu1">Teachers</a></li>
            <li><a data-toggle="tab" href="#classes">Classes</a></li>

        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="row marginTop">
                    <div class="col-md-10">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Assign Teacher for <b>{{$subject->name}}</b> Course
                            </div>
                            <div class="panel-body">


                                <form method="post" action="{{url('subjects/saveSubjectTeacher')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                                    <!-- teachers list -->
                                    <select class="form-control marginTop controlWidth center-block" name="teacher" >

                                        <option>Select Teacher</option>
                                        @foreach($teachers as $teacher)
                                            <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                        @endforeach
                                    </select>

                                    <input type="hidden" value="{{$subject->id}}" name="subject">

                                    <div class="form-group marginTop">
                                        <input type="submit" value="Submit" class="btn btn-info form-control">
                                    </div>

                                </form>


                            </div>
                            <div class="panel-footer">
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
                </div>
            </div>

            {{--teachers--}}
            <div id="menu1" class="tab-pane fade">
                <table class="table table-responsive table-striped marginTop">
                    @foreach($subjectTeachers as $teacher)
                        <tr>
                            <td>{{$teacher->name}}</td>
                            <td><a href="{{url('subjects/remove-teacher/'.$subject->id.'/'.$teacher->id)}}">Remove</a> </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            {{--classes--}}

            <div id="classes" class="tab-pane fade">
                <table class="table table-responsive table-striped marginTop">
                    @foreach($classes as $class)
                        <tr>
                            <td>{{$class->name}}</td>
                            <td><a href="{{url('subjects/remove-class/'.$subject->id.'/'.$class->id)}}">Remove</a> </td>
                        </tr>
                    @endforeach
                </table>
            </div>

        </div>
    </div>



<script>
    $(document).ready(function() {
        var max_fields      = 20; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID
        var data_num = parseInt($('.name').attr("data-num"));



        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                data_num++;
                $(wrapper).append('<div class="row marginTop" id="row">' +
                        '<div class="col-md-4"><input type="text" name="name['+data_num+'][]" class="form-control" placeholder="name" id="name" required/></div> ' +
                        '<div class="col-md-4"><input type="text" name="fname['+data_num+'][]" class="form-control" placeholder="father name" required/></div>' +
                        '<div class="col-md-1"><a href="#" class="remove_field glyphicon glyphicon-remove marginTop" aria-hidden="true"></a></div>' +
                        '</div>'); //add input box
            }
        });

        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault();
            $(this).parent("div").parent("div").remove();
            x--;
            $(this).parent("div").parent("div").remove();
            x--;
            data_num--;
        })
    });
</script>

@endsection