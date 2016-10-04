@extends('layouts.master')
@section('content')

    <div class="container">

        <h2>{{$class->name}}</h2>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
            <li><a data-toggle="tab" href="#menu1">Pre-existing Students</a></li>

        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="row marginTop">
                    <div class="col-md-10">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Assign Students for <b>{{$class->name}}</b> Class
                    </div>
                    <div class="panel-body">

                        <form method="post" action="{{url('classes/saveClassStudents/'.$class->id)}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

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

            <div id="menu1" class="tab-pane fade">
                <?php ?>
                <select name="class" class="form-control controlWidth marginTop">
                    <option>Filter Students by class</option>
                    @foreach($classes as $class)
                        <option value="{{$class->id}}"  id="classes">{{$class->name}}</option>
                    @endforeach
                </select>
                <div id="preStudents" class="center-block marginTop">
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
    <script>
        $(function(){

            $('select[name="class"]').change(function(){
                var id = $('select[name=class]').val();
                $.ajax({
                    url:'/students/filter/preStudents/'+id+'/'+'{{ $class->id }}',
                    success:function(data){
                        console.log(data)
                        $('#preStudents').empty();
                        $('#preStudents').append(data);
                    }
                });
            });

        });
    </script>

@endsection