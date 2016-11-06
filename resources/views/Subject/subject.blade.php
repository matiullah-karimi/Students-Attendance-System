@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Courses</div>

                    <div class="panel-body">

                        <a href="{{url('subjects/create')}}" class="btn btn-success">Create a Subject</a>


                        <table class="table table-responsive table-bordered marginTop">
                            <thead>
                            <th>Name</th>
                            <th>Assign Students</th>
                            <th colspan="2">Actions</th>
                            </thead>

                            <tbody>

                                @foreach($subjects as $subject)
                                    <tr>
                                    <td>{{$subject->name}}</td>
                                    <td><a href="{{url('subjects/assignTeacher/'.$subject->id)}}" class="btn btn-warning">Assign Teacher</a> </td>
                                    <td> <a href="{{url('subjects/'.$subject->id.'/edit')}}"  value="Edit" class="btn btn-info btn-group-sm "> Edit</a> </td>

                                    <td>
                                        <a href="javascript:void(0)" id="{{ $subject->id }}" class="btn btn-danger delete" onclick="confirm(this.id);">
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
                var url = '{{url('subjects/destroy')}}/'+id;
                $('a.delete').attr('href', url);
            });

        };
    </script>

@endsection