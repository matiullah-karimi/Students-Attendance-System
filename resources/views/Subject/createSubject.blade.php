@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('language.create-subject')</div>

                    <div class="panel-body">
                        <form method="post" action="{{ url('subjects') }}">
                            <input type="hidden" value="{{csrf_token()}}" name="_token">
                            <label class="control-label">@lang('language.select-classes')</label>
                            <div class="form-group">
                                <select id="classes" name="classes[]" multiple="multiple" class="form-control controlWidth">
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}">{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group marginTop">
                                <button class="add_field_button btn btn-success">@lang('language.create-more')</button>

                            </div>
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <input type="text" class="form-control" name="name[]" required placeholder="subject name">
                            </div>
                            <div class="input_fields_wrap">
                            </div>
                            <div class="form-group marginTop">
                                <input type="submit" class="form-control btn btn-info" value="{{trans('language.submit')}}">
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
            var max_fields = 20; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap"); //Fields wrapper
            var add_button = $(".add_field_button"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function (e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div class="row marginTop" id="row">' +
                            '<div class="col-md-4"><input type="text" name="name[]" class="form-control" placeholder="subject name" id="name" required/></div> '+
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
            })
        });
    </script>
@endsection

@section('page_specific_scripts')
    <script>
        $(document).ready(function() {
            $('#classes').multiselect({
                includeSelectAllOption: true,
                enableFiltering: true,
                buttonWidth: '400px'
            });
        });
    </script>
    @endsection