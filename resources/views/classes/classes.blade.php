@extends('layouts.master')
@section('page_specific_styles')
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Teachers</div>

                    <div class="panel-body">
                        <a href="{{url('classes/create')}}" class="btn btn-lg btn-success">Add Class</a>

                        <table class="table table-bordered table-responsive marginTop">
                            <thead>
                            <th>Name</th>
                            <th>Assign Students</th>
                            <th colspan="2">Actions</th>
                            </thead>

                            <tbody>

                            @foreach($classes as $class)
                                <tr>

                                    <td>{{$class->name}}</td>
                                    <td><a href="{{url('classes/assignStudents/'.$class->id)}}" class="btn btn-warning">Assign Students</a> </td>
                                    <td> <a href="{{url('classes/'.$class->id.'/edit')}}"  value="Edit" class="btn btn-info btn-group-sm fa fa-edit "> Edit</a></td>

                                    <td>
                                        <form action="{{url('classes/'.$class->id)}}" method="post" id="{{$class->id}}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="form-group">

                                                {{--<button class="btn btn-danger fa fa-trash-o " type="submit"> Delete</button>--}}
                                                <button class="btn btn-xs btn-danger delete" type="button" data-toggle="modal" data-target="#confirmDelete" data-id="{{ $class->id }}" id="{{ $class->id }}">
                                                Delete</button>

                                            </div>
                                        </form>
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@include('deleteModalConfirmation')
@section('page_specific_scripts')

    <script>

        $(function(){
            <!-- Form confirm (yes/ok) handler, submits form -->
            $('.confirm').click(function(){

                event.preventDefault();

                var id = $(this).val('#delete');

                console.log(id);

//                alert(id);

//     $('form').submit();
            });

        });

    </script>

@endsection
