@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Assign Students for <b>{{$subject->name}}</b> Course
                    </div>
                    <div class="panel-body">


                        <form method="post" action="{{url('subjects/saveStudents')}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <!-- teachers list -->
                            <select class="form-control marginTop controlWidth center-block" name="teacher" >

                                <option>Select Teacher</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                @endforeach
                            </select>

                            <!-- classes list -->
                            <select class="form-control marginTop controlWidth center-block" name="class">

                                <option>Select Class</option>
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                @endforeach
                            </select>

                            <!-- subject id -->

                            <input type="hidden" value="{{$subject->id}}" name="subject">

                            <div class="form-group marginTop">
                                <button class="add_field_button btn btn-success">Add More Fields</button>

                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                        <div class=" form-group">
                                            <input type="text" name="name[0][]" class="name form-control" placeholder="name" data-num ="0" required >
                                        </div>
                                    </div>

                                <div class="col-md-4">
                                    <input type="text" name="fname[0][]" class="fname form-control" placeholder="father name" data-num ="0" required>
                                </div>

                                </div>

                    <div class="input_fields_wrap">
                    </div>


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