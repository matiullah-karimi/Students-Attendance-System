@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Assign Students for {{$subject->name}} Course
                    </div>
                    <div class="panel-body">


                        <form method="post" action="{{url('subjects/saveStudents')}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <!-- teachers list -->
                            <select class="form-control" name="teacher">

                                <option>Select Teacher</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{$teacher}}">{{$teacher->name}}</option>
                                @endforeach
                            </select>

                            <!-- classes list -->
                            <select class="form-control" name="class">

                                <option>Select Class</option>
                                @foreach($classes as $class)
                                    <option>{{$class->name}}</option>
                                @endforeach
                            </select>

                            <label class="label-info text-center center-block control-label" style="margin-top: 10px;
                            height: 20px;">Students Entry</label>

                            <div class="row" style="margin-top: 5px;
                            padding:5px; border: lightseagreen">
                                <div class="col-md-7">

                                    <div class="input_fields_wrap form-group margin">
                                        <button class="add_field_button btn btn-success">Add More Fields</button>
                                        <div class="marginTop">
                                            <input type="text" name="name[0][]" class="name" placeholder="name" data-num ="0">
                                            <input type="text" name="fname[0][]" class="fname" placeholder="father name" data-num ="0">
                                            <a class="close marginleft" href="#" aria-hidden="true"></a>

                                        </div>
                                    </div>

                                </div>



                                <div class="col-md-6">

                                    </div>


                                <div class="form-group">
                                    <input type="submit" value="Submit" class="btn btn-info form-control">
                                </div>

                        </div>

                        </form>


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
                $(wrapper).append('<div>' +
                        '<input type="text" name="name['+data_num+'][]" class="margin" placeholder="name" id="name"/> ' +
                        '<input type="text" name="fname['+data_num+'][]" class="" placeholder="father name"/>' +
                        '<a href="#" class="remove_field close marginTop"aria-hidden="true" ">&times;</a>' +
                        '</div>'); //add input box
            }
        });

        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
             $(this).parent('div').remove(); x--;
            data_num--;
        })
    });
</script>

@endsection