@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Teachers</div>

                    <div class="panel-body">
                        <a href="{{url('users/create')}}" class="btn btn-lg btn-success">Add Teacher</a>

                        <table class="table table-bordered table-responsive marginTop">
                            <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Assign Classes</th>
                            <th colspan="2">Actions</th>
                            </thead>

                            <tbody>

                                @foreach($teachers as $teacher)
                                    <tr>

                                <td>{{$teacher->name}}</td>
                                <td>{{$teacher->email}}</td>
                                <td><a href="{{url('users/assignClasses/'.$teacher->id)}}" class="btn btn-warning">Assign Classes</a></td>
                                    <td> <a href="{{url('users/'.$teacher->id.'/edit')}}"  value="Edit" class="btn btn-info btn-group-sm">Edit</a></td>

                                    <td>
                                        <a href="javascript:void(0)" id="{{ $teacher->id }}" class="btn btn-danger delete" onclick="confirm(this.id);">
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

@endsection

@include('deleteModalConfirmation')
@section('page_specific_scripts')

    <script>
        function confirm(id){
            $('#confirmDelete').modal('show');
            <!-- Form confirm (yes/ok) handler, submits form -->
            $('.confirm').click(function(){
                var url = '{{url('users/destroy')}}/'+id;
                $('a.delete').attr('href', url);
            });

        };
    </script>

@endsection