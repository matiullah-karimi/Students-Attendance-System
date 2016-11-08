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
                        <a href="{{url('classes/create')}}" class="btn btn-success">Add Class</a>

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
                                        <a href="javascript:void(0)" id="{{ $class->id }}" class="btn btn-danger delete" onclick="confirm(this.id);">
                                                Delete</a>
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
    @include('deleteModalConfirmation')
@endsection

@section('page_specific_scripts')

    <script>

        function confirm(id){
            $('#confirmDelete').modal('show');
            <!-- Form confirm (yes/ok) handler, submits form -->
            $('.confirm').click(function(){
                var url = '{{url('classes/destroy')}}/'+id;
                $('a.delete').attr('href', url);
            });

        };

    </script>

@endsection
